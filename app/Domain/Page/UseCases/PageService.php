<?php


namespace App\Domain\Page\UseCases;


use App\Domain\_core\Service;
use App\Domain\Page\Entities\Page;
use App\Domain\Page\Entities\PageDocument;
use App\Domain\Page\Repositories\PageReadRepository;
use App\Http\Requests\Admin\Page\PageSearchRequest;
use App\Http\Requests\Admin\Page\PageStoreRequest;
use App\Http\Requests\Admin\Page\PageUpdateRequest;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class PageService
 * @package App\Domain\Page\UseCases
 *
 * @property Page $pages
 * @property PageReadRepository $pageReadRepo
 */
class PageService extends Service
{
    private $pages;
    private $pageReadRepo;

    /**
     * PageService constructor.
     * @param Page $page
     * @param PageReadRepository $pageReadRepo
     */
    public function __construct(Page $page, PageReadRepository $pageReadRepo)
    {
        $this->pages = $page;
        $this->pageReadRepo = $pageReadRepo;
    }

    /**
     * @param PageSearchRequest $request
     * @return mixed
     */
    public function search(PageSearchRequest $request)
    {
        return $this->pageReadRepo->getSearchQuery($request->id, $request->name, $request->input('content'));
    }

    /**
     * @param PageStoreRequest $request
     * @return Page
     * @throws \Throwable
     */
    public function store(PageStoreRequest $request): Page
    {
        try{
            DB::beginTransaction();
            $page = $this->pages->create($request->except('documents'));

            if(isset($request->documents))
                $this->setDocuments(collect($request->documents), $page);

            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            throw $exception;
            throw new Exception("WHOOPS");
        }

        return $page;
    }

    /**
     * @param PageUpdateRequest $request
     * @param Page $page
     * @return Page
     * @throws \Throwable
     */
    public function update(PageUpdateRequest $request, Page $page): Page
    {
        try{
            DB::beginTransaction();
            $page->update($request->except('documents'));

            if(isset($request->documents))
                $this->setDocuments(collect($request->documents), $page);

            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            throw $exception;
            throw new Exception("WHOOPS");
        }
        return $page;
    }

    public function setDocuments(Collection $files, Page $page): Collection
    {
        $documents = collect();

        $files = $files->map(function ($value, $key) use (&$documents, $page) {
            $documents->push(['page_id' => $page->id]);
            return $value;
        });

        /** @var PageDocument[]|Collection $documents */
        $documents = $page->documents()->createMany($documents->toArray());

        foreach ($files as $i => $file)
            $documents[$i]->updateManual($file);

        return $documents;
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(int $id): ?bool
    {
        $Page = $this->pages->find($id);

        return $Page->delete();
    }
}
