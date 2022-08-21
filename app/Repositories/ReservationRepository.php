<?php

namespace App\Repositories;

use App\Models\Room;

class ReservationRepository
{
    public function unoccupiedRoom($request, $occupiedRoomId){
        $rooms = Room::with('type', 'roomStatus')
            ->where('capacity', '>=', $request->count_person)
            ->whereNotIn('id', $occupiedRoomId);
        if (!empty($request->sort_name)) {
            $rooms = $rooms->orderBy($request->sort_name, $request->sort_type);
        }
        return $rooms;
    }
    public function getUnoccupiedRoom($request, $occupiedRoomId)
    {
        return $this->unoccupiedRoom($request,$occupiedRoomId)
                ->orderBy('capacity','asc')
                ->paginate(5);
    }

    public function countUnoccupiedRoom($request, $occupiedRoomId)
    {
        return $this->unoccupiedRoom($request,$occupiedRoomId)->count();
    }
}
