<?php


namespace App\Domain\Line\UseCases;


use App\Domain\_core\Service;
use App\Domain\Line\Entities\Line;
use App\Domain\Line\ReadRepositories\LineReadRepository;
use App\Http\Requests\Admin\Line\LineSearchRequest;
use App\Http\Requests\Admin\Line\LineStoreRequest;
use App\Http\Requests\Admin\Line\LineUpdateRequest;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

/**
 * Class LineService
 * @package App\Domain\Line\UseCases
 *
 * @property LineReadRepository $lineReadRepo
 * @property Line $lines
 */
class LineService extends Service
{
    private $lineReadRepo;
    private $lines;

    public function __construct(Line $lines, LineReadRepository $lineReadRepo)
    {
        $this->lineReadRepo = $lineReadRepo;
        $this->lines = $lines;
    }

    /**
     * @param LineSearchRequest $request
     * @return Builder
     */
    public function search(LineSearchRequest $request): Builder
    {
        return $this->lineReadRepo->getSearchQuery($request->id, $request->name)
            ->orderByDesc('id');
    }

    /**
     * @param LineStoreRequest $request
     * @return Line
     * @throws Throwable
     */
    public function create(LineStoreRequest $request): Line
    {
        return $this->lines->create($request->validated());
    }

    /**
     * @param LineUpdateRequest $request
     * @param Line $line
     * @return Line
     * @throws Throwable
     */
    public function update(LineUpdateRequest $request, Line $line): Line
    {
        $line->update($request->validated());

        return $line;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id): bool
    {
        $line = $this->lines->findOrfail($id);
        return $line->delete();
    }
}
