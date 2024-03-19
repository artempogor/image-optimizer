<?php

namespace App\Http\Controllers;

use App\Services\Optimize\CompressService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class OptimizeController
{
    public function __construct(
        private readonly CompressService $optimizeService
    )
    {
    }

    /**
     * @throws \ImagickException
     */
    public function compress(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|file',
            'optimize_level' => 'nullable|integer|max:99',
        ]);

        if($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $result = $this->optimizeService->compress($request->file('image'), $request->get('optimize_level'));

        return response(
            content: $result,
            status: 200,
        );
    }
}