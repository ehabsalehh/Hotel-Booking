<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomStatusRequest;
use App\Models\RoomStatus;
use App\Repositories\RoomStatusRepository;
use Illuminate\Http\Request;

class RoomStatusController extends Controller
{
    private $roomStatusRepository;

    public function __construct(RoomStatusRepository $roomStatusRepository)
    {
        $this->roomStatusRepository = $roomStatusRepository;
    }
    public function index(Request $request)
    {
        $roomstatuses = $this->roomStatusRepository->getRoomStatuses($request);
        return view('roomstatus.index', compact('roomstatuses'));
    }

    public function create()
    {
        return view('roomstatus.create');
    }

    public function store(StoreRoomStatusRequest $request)
    {
        $roomStatus = RoomStatus::create($request->all());
        return redirect()->route('roomStatus.index')
                ->with('success', 'Room ' . $roomStatus->name . ' created');
    }

    public function edit(RoomStatus $roomStatus)
    {
        // dd($roomStatus);
        return view('roomStatus.edit', compact('roomStatus'));
    }

    public function update(StoreRoomStatusRequest $request, RoomStatus $roomStatus)
    {
        $roomStatus->update($request->all());
        return redirect()->route('roomStatus.index')->with('success', 'Room ' . $roomStatus->name . ' updated!');
    }

    public function destroy(RoomStatus $roomStatus)
    {
        try {
            $roomStatus->delete();
            return redirect()->route('roomStatus.index')->with('success', 'Room ' . $roomStatus->name . ' deleted!');
        } catch (\Exception $e) {
            return redirect()->route('roomStatus.index')->with('failed', 'Room ' . $roomStatus->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);;
        }
    }
}
