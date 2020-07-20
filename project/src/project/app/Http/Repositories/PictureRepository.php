<?php

namespace App\Http\Repositories;

use App\Http\Dto\PictureDto;
use App\Http\Requests\RestRequests\RestRequest;
use App\Model\Picture;
use Illuminate\Support\Facades\DB;

class PictureRepository implements Repository
{
    public function read(RestRequest $request)
    {
        $data = Picture::where('id', $request->id)->get();
        if (count($data) == 0) {
            $data = null;
        } else {
            $data = $data[0]->getAttributes();
            $data = new PictureDto(intval($data['id']),
                $data['owner_email'],
                $data['location'],
                $data['path'],
                $data['created_date'],
                $data['updated_date']
            );
        }
        return $data;
    }

    public function readWithPicture(RestRequest $request)
    {
        $data = Picture::where('id', $request->id)->get();
        if (count($data) == 0) {
            $data = null;
        } else {
            $data = $data[0]->getAttributes();
            $data = new PictureDto(intval($data['id']),
                $data['owner_email'],
                $data['location'],
                $data['path'],
                $data['created_date'],
                $data['updated_date']
            );
        }
        return $data;
    }

    public function readWithUser(RestRequest $request)
    {
        $ret = [];
        $datas = Picture::join('user', 'user.email', '=', 'picture.owner_email')
            ->where('email', $request->id)->select('id',
                'owner_email',
                'location',
                'path',
                'picture.created_date as created_date',
                'picture.updated_date as updated_date'
            )->get();
        if (count($datas) == 0) {
            $data = null;
        } else {
            foreach ($datas as $data) {
                $data = $data->getAttributes();
                $data = new PictureDto(intval($data['id']),
                    $data['owner_email'],
                    $data['location'],
                    $data['path'],
                    $data['created_date'],
                    $data['updated_date']
                );
                array_push($ret, $data);
            }
        }
        return $ret;
    }

    public function create(RestRequest $request)
    {
        DB::beginTransaction();
        $data = new Picture();
        $data->id = $request->id;
        $data->owner_email = $request->owner_email;
        $data->location = $request->location;
        $data->path = $request->path;
        $data->save();
        $data = DB::select('select last_insert_id() as id')[0];
        DB::commit();
        return $data;
    }

    public function update(RestRequest $request)
    {
        $arr = [
            'id' => $request->id,
            'owner_email' => $request->owner_email,
            'location' => $request->location,
            'path' => $request->path,
            'created_date' => $request->created_date,
            'updated_date' => $request->updated_date,
        ];
        foreach ($arr as $key => $value) {
            if ($value === null) {
                unset($arr[$key]);
            }
        }
        $data = Picture::where('id', $request->id)->update($arr);
        return $data;
    }

    public function delete(RestRequest $request)
    {
        $data = Picture::where('id', $request->id)->delete();
        return $data;
    }
}
