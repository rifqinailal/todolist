<?php

namespace App\Controllers;

use App\Models\TasksModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $tasksModel = new TasksModel();
        $tasks = $tasksModel->findAll();
        $pendingTasks = 0;
        $completedTasks = 0;

        foreach ($tasks as $task) {
            if ($task['status'] == 'pending') {
                $pendingTasks++;
            } else if ($task['status'] == 'completed') {
                $completedTasks++;
            }
        }

        $data = [
            'tasks' => $tasks,
            'pendingTasks' => $pendingTasks,
            'completedTasks' => $completedTasks
        ];

        return view('dashboard', $data);
    }

    // public function sendReport()
    // {
    //     $tasksModel = new TasksModel();


    //     $pendingTasks = $tasksModel->where('status', 'pending')->findAll();
    //     $pendingCount = count($pendingTasks);


    //     $completedTasks = $tasksModel->where('status', 'completed')->findAll();
    //     $completedCount = count($completedTasks);


    //     $message = "*LAPORAN TUGAS*\n\n";
    //     $message .= " *Total Tugas Belum Selesai:* " . $pendingCount . "\n";
    //     $message .= " *Total Tugas Selesai:* " . $completedCount . "\n\n";

    //     $message .= " *Tugas Belum Selesai:*\n";
    //     foreach ($pendingTasks as $task) {
    //         $message .= "- " . $task['title'] . " (Deadline: " . date('d/m/Y', strtotime($task['deadline'])) . ")\n";
    //         $message .= "  Deskripsi: " . $task['description'] . "\n";
    //     }

    //     $message .= "\n *Tugas Selesai:*\n";
    //     foreach ($completedTasks as $task) {
    //         $message .= "- " . $task['title'] . " (Selesai: " . date('d/m/Y', strtotime($task['updated_at'])) . ")\n";
    //         $message .= "  Deskripsi: " . $task['description'] . "\n";
    //     }


    //     $phoneNumber = "6287861337682";

    //     // Encode pesan untuk URL
    //     $encodedMessage = urlencode($message);

    //     // Redirect ke WhatsApp
    //     return redirect()->to("https://wa.me/$phoneNumber?text=$encodedMessage");
    // }


    public function sendReport()
    {
        try {
            $tasksModel = new TasksModel();

            // Ambil data
            $pendingTasks = $tasksModel->where('status', 'Pending')->findAll();
            $completedTasks = $tasksModel->where('status', 'Completed')->findAll();

            if (empty($pendingTasks) && empty($completedTasks)) {
                return redirect()->to('/dashboard')
                    ->with('warning', 'Tidak ada data tugas untuk dilaporkan');
            }

            // Format pesan
            $message = "*LAPORAN TUGAS*\n";
            $message .= "_" . date('d/m/Y H:i') . "_\n\n";

            $message .= "*Total Tugas Belum Selesai:* " . count($pendingTasks) . "\n";
            $message .= "*Total Tugas Selesai:* " . count($completedTasks) . "\n\n";

            if (!empty($pendingTasks)) {
                $message .= "*Tugas Belum Selesai:*\n";
                foreach ($pendingTasks as $task) {
                    $message .= "- " . $task['title'] . "\n";
                    $message .= "  Deadline: " . date('d/m/Y', strtotime($task['deadline'])) . "\n";
                    $message .= "  Deskripsi: " . $task['description'] . "\n\n";
                }
            }

            if (!empty($completedTasks)) {
                $message .= "\n*Tugas Selesai:*\n";
                foreach ($completedTasks as $task) {
                    $message .= "- " . $task['title'] . "\n";
                    $message .= "  Selesai: " . date('d/m/Y', strtotime($task['updated_at'])) . "\n";
                    $message .= "  Deskripsi: " . $task['description'] . "\n\n";
                }
            }

            $curl = curl_init();

            // Data untuk kirim ke grup
            $data = [
                'target' => '120363387633792620@g.us', 
                'message' => $message,
                'delay' => 1,
            ];

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: HAXC6tQ95UJwLerTKpCE'
                ),
            ));

            $response = curl_exec($curl);
            log_message('info', 'Fonnte Response: ' . $response);

            if (curl_errno($curl)) {
                throw new \Exception(curl_error($curl));
            }

            curl_close($curl);
            $result = json_decode($response, true);

            if (isset($result['status']) && $result['status'] === true) {
                return redirect()->to('/dashboard')
                    ->with('success', 'Laporan berhasil dikirim ke Grup WhatsApp');
            } else {
                $errorMessage = isset($result['reason']) ? $result['reason'] : 'Unknown error';
                return redirect()->to('/dashboard')
                    ->with('error', 'Gagal mengirim laporan: ' . $errorMessage);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error in sendReport: ' . $e->getMessage());
            return redirect()->to('/dashboard')
                ->with('error', 'Terjadi kesalahan saat mengirim laporan');
        }
    }

    
}
