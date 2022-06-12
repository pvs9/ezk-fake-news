<?php

namespace App\Http\Controllers\Api;

use App\DTO\ArticleAnalysisDTO;
use App\Http\Requests\AnalyzeArticleRequest;
use App\Services\AnalysisService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ArticleController extends ApiController
{
    public function analyze(AnalyzeArticleRequest $request, AnalysisService $service): JsonResponse
    {
        try {
            $dto = ArticleAnalysisDTO::fromRequest($request);

            $report = $service->analyze($dto);

            return $this->okResponse($report);
        } catch (Exception $e) {
            Log::error(
                '[ANALYZE] Error occurred while analyzing article',
                [
                    'dto' => $dto ?? null,
                    'request' => $request->all(),
                    'exception' => $e
                ]
            );

            return $this->errorResponse(trans('errors.article.analyze'));
        }
    }
}
