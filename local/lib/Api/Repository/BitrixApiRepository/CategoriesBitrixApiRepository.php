<?php


namespace App\Api\Repository\BitrixApiRepository;


use App\Api\Category;
use App\Api\Repository\BitrixApiRepository\Dao\CategoriesBitrixApiDao;
use CIBlockResult;

class CategoriesBitrixApiRepository implements BitrixApiRepository
{
    /**
     * @var Category
     */
    private $category;
    /**
     * @var array Category
     */
    private $categories;

    /**
     * @var CategoriesBitrixApiDao
     */
    private $dao;

    public function __construct()
    {
        $this->dao = new CategoriesBitrixApiDao();
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $result = $this->dao->getAll();

        return $this->toArrayOfCategoryObjects($result);
    }

    /**
     * @param int $id
     * @return Category
     */
    public function getById(int $id)
    {
        $result = $this->dao->getById($id);

        return $this->toCategoryObject($result);
    }

    /**
     * @param array $articleIds
     * @return array
     */
    public function getByArticleIds(array $articleIds): array
    {
        $result = $this->dao->getByArticleIds($articleIds);

        while ($arFields = $result->GetNext(true, false)) {
            $category = $this->createCategory($arFields['ID'], $arFields['NAME']);

            $this->categories[$arFields['IBLOCK_ELEMENT_ID']][] = $category;

            unset($category);
        }

        return $this->categories;
    }

    /**
     * @param CIBlockResult $result
     * @return Category
     */
    private function toCategoryObject(CIBlockResult $result)
    {
        while ($arFields = $result->GetNext(true, false)) {
            $this->category = $this->createCategory($arFields['ID'], $arFields['NAME']);
        }

        return $this->category;
    }

    /**
     * @param CIBlockResult $result
     * @return array
     */
    private function toArrayOfCategoryObjects(CIBlockResult $result)
    {
        while ($arFields = $result->GetNext(true, false)) {
            $category = $this->createCategory($arFields['ID'], $arFields['NAME']);

            $this->categories[] = $category;

            unset($category);
        }

        return $this->categories;
    }

    public function createCategory(string $id, string  $name)
    {
        $category = new Category();
        $category->create($id, $name);

        return $category;
    }
}