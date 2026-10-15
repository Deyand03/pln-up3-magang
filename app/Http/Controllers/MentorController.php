<?php

namespace App\Http\Controllers;

use App\Models\Internships;
use App\Models\Logbooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorController extends Controller
{
    public function index()
    {
        $mentorId = Auth::user()->id;

        $dataIntern = Internships::with(['applications', 'user', 'attendanceToday'])
            ->withCount([
                'logbooks as pending_logbooks_count' => function ($query) {
                    $query->where('status', 'pending');
                },
            ])
            ->where('mentor_id', $mentorId)
            ->get();

        $totalBimbingan = $dataIntern->count();
        $totalPendingLogbooks = $dataIntern->sum('pending_logbooks_count');

        $totalHadirHariIni = $dataIntern->filter(function ($intern) {
            return $intern->attendanceToday && $intern->attendanceToday->status === 'hadir';
        })->count();

        return view('mentor.index', compact(
            'dataIntern',
            'totalBimbingan',
            'totalPendingLogbooks',
            'totalHadirHariIni'
        ));
    }

    public function showInternshipDetails(Request $request, $id)
    {
        $mentorId = Auth::user()->id;

        $intern = Internships::with(['user', 'applications'])
            ->withCount([
                'logbooks',
                'attendances',
                'logbooks as pending_logbooks_count' => function ($query) {
                    $query->where('status', 'pending');
                },
            ])
            ->where('mentor_id', $mentorId)
            ->findOrFail($id);

        $logbookQuery = $intern->logbooks()->orderBy('date', 'desc');

        if ($request->query('filter_pending') === 'true') {
            $logbookQuery->where('status', 'pending');
        }

        $logbooks = $logbookQuery->paginate(10, ['*'], 'logbook_page');

        $attendances = $intern->attendances()
            ->orderBy('date', 'desc')
            ->paginate(10, ['*'], 'presensi_page');

        if ($request->ajax()) {
            if ($request->has('logbook_page') || $request->has('filter_pending')) {
                return view('mentor.partials.logbook-list', compact('logbooks'))->render();
            } elseif ($request->has('presensi_page')) {
                return view('mentor.partials.presensi-list', compact('attendances'))->render();
            }
        }

        return view('mentor.show', compact('intern', 'logbooks', 'attendances'));
    }

    public function toggleLogbookStatus(Request $request, $id)
    {
        $mentorId = Auth::user()->id;

        $logbook = Logbooks::whereHas('internship', function ($query) use ($mentorId) {
            $query->where('mentor_id', $mentorId);
        })->findOrFail($id);

        $logbook->update([
            'status' => $logbook->status === 'pending' ? 'approved' : 'pending',
        ]);

        return redirect()->back()->with('success', 'Status logbook berhasil diperbarui.');
    }

    public function profile()
    {
        return redirect()->route('dashboard-mentor');
    }
}
