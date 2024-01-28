<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class CommonController extends Controller
{
    //
    use ApiResponse;
    public function getDeleteModal(Request $request)
    {
        $data = $request->only('url', 'type');
        $html = ( string )view(
            'Admin.common.deleteModal',
            compact(
                'data'
            )
        );
        return $this->sendResponse('Page load successfully.', 200, $html);
    }

    public function getMulDeleteModal(Request $request)
    {
        $data = $request->only('url', 'type');
        $html = ( string )view(
            'Admin.common.deleteMultipleModal',
            compact(
                'data'
            )
        );
        return $this->sendResponse('Page load successfully.', 200, $html);
    }

}
