<?php

namespace App\Http\Controllers;

use App\Services\Optimize\CompressService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use ImagickException;
use Laravel\Lumen\Application;

class OptimizeController
{
    public function __construct(
        private readonly CompressService $optimizeService
    )
    {
    }

    /**
     * @throws ImagickException
     */
    public function compressFromWeb(Request $request): View|Application
    {
        $item = $this->compress($request);

        return view('upload', ['statistic' => $item]);

    }
    /**
     * @throws ImagickException
     */
    public function compress(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:500000',
            'optimize_level' => 'nullable|integer|max:99',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 402);
        }

        $result = $this->optimizeService->compress($request->file('image'), $request->get('optimize_level'));

        return response(
            content: $result,
            status: 200,
        );
    }
}