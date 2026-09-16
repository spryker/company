<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Company\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Spryker\Zed\Company\Persistence\CompanyPersistenceFactory getFactory()
 */
class CompanyRepository extends AbstractRepository implements CompanyRepositoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @param int $idCompany
     *
     * @return \ArrayObject<int, \Generated\Shared\Transfer\StoreTransfer>
     */
    public function getRelatedStoresByCompanyId(int $idCompany)
    {
        $companyStoreEntities = $this->getFactory()
            ->createCompanyStoreQuery()
            ->filterByFkCompany($idCompany)
            ->find();

        $relatedStores = new ArrayObject();

        foreach ($companyStoreEntities as $companyStoreEntity) {
            $storeTransfer = new StoreTransfer();
            $storeTransfer->setIdStore($companyStoreEntity->getFkStore());
            $relatedStores->append($storeTransfer);
        }

        return $relatedStores;
    }

    /**
     * {@inheritDoc}
     *
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function getCompanyById(int $idCompany): CompanyTransfer
    {
        $spyCompany = $this->getFactory()
            ->createCompanyQuery()
            ->filterByIdCompany($idCompany)
            ->findOne();

        return $this->getFactory()
            ->createCompanyMapper()
            ->mapEntityToCompanyTransfer($spyCompany, new CompanyTransfer());
    }

    public function findCompanyById(int $idCompany): ?CompanyTransfer
    {
        $companyEntity = $this->getFactory()
            ->createCompanyQuery()
            ->filterByIdCompany($idCompany)
            ->findOne();

        if (!$companyEntity) {
            return null;
        }

        return $this->getFactory()
            ->createCompanyMapper()
            ->mapEntityToCompanyTransfer($companyEntity, new CompanyTransfer());
    }

    /**
     * {@inheritDoc}
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function getCompanies(): CompanyCollectionTransfer
    {
        $spyCompanies = $this->buildQueryFromCriteria(
            $this->getFactory()->createCompanyQuery(),
        )->find();

        $spyCompanies = new ArrayObject($spyCompanies);
        $companyTypeCollection = new CompanyCollectionTransfer();
        $companyTypeCollection->setCompanies($spyCompanies);

        return $companyTypeCollection;
    }

    public function findCompanyByUuid(string $companyUuid): ?CompanyTransfer
    {
        $companyEntity = $this->getFactory()
            ->createCompanyQuery()
            ->filterByUuid($companyUuid)
            ->findOne();

        if (!$companyEntity) {
            return null;
        }

        return $this->getFactory()
            ->createCompanyMapper()
            ->mapEntityToCompanyTransfer($companyEntity, new CompanyTransfer());
    }

    public function getCompanyCollection(CompanyCriteriaFilterTransfer $companyCriteriaFilterTransfer): CompanyCollectionTransfer
    {
        $companyQuery = $this->getFactory()
            ->createCompanyQuery();

        $companyQuery = $this->setCompanyFilters(
            $companyQuery,
            $companyCriteriaFilterTransfer,
        );

        $companyQuery = $this->applySortToQuery($companyQuery, $companyCriteriaFilterTransfer);

        $paginationTransfer = $companyCriteriaFilterTransfer->getPagination();
        $companyQuery = $this->applyPagination($companyQuery, $paginationTransfer);

        $companyCollectionTransfer = $this->getFactory()
            ->createCompanyMapper()
            ->mapCompanyEntityCollectionToCompanyCollectionTransfer($companyQuery->find());

        return $companyCollectionTransfer->setPagination($paginationTransfer);
    }

    protected function applySortToQuery(
        SpyCompanyQuery $companyQuery,
        CompanyCriteriaFilterTransfer $companyCriteriaFilterTransfer
    ): SpyCompanyQuery {
        $sortableFieldMap = $this->getFactory()->getConfig()->getCompanyCollectionSortableFieldMap();

        foreach ($companyCriteriaFilterTransfer->getSortCollection() as $sortTransfer) {
            $column = $sortableFieldMap[$sortTransfer->getField()] ?? null;

            if ($column === null) {
                continue;
            }

            $companyQuery->orderBy($column, $sortTransfer->getIsAscending() === false ? Criteria::DESC : Criteria::ASC);
        }

        $companyQuery->orderBy(SpyCompanyTableMap::COL_ID_COMPANY, Criteria::DESC);

        return $companyQuery;
    }

    protected function applyPagination(
        SpyCompanyQuery $companyQuery,
        ?PaginationTransfer $paginationTransfer
    ): SpyCompanyQuery {
        if ($paginationTransfer === null) {
            return $companyQuery;
        }

        $paginationModel = $companyQuery->paginate(
            $paginationTransfer->requirePage()->getPage(),
            $paginationTransfer->requireMaxPerPage()->getMaxPerPage(),
        );

        $paginationTransfer->setPage($paginationModel->getPage());
        $paginationTransfer->setNbResults($paginationModel->getNbResults());
        $paginationTransfer->setFirstIndex($paginationModel->getFirstIndex());
        $paginationTransfer->setLastIndex($paginationModel->getLastIndex());
        $paginationTransfer->setFirstPage($paginationModel->getFirstPage());
        $paginationTransfer->setLastPage($paginationModel->getLastPage());
        $paginationTransfer->setNextPage($paginationModel->getNextPage());
        $paginationTransfer->setPreviousPage($paginationModel->getPreviousPage());

        /** @var \Orm\Zed\Company\Persistence\SpyCompanyQuery $paginatedCompanyQuery */
        $paginatedCompanyQuery = $paginationModel->getQuery();

        return $paginatedCompanyQuery;
    }

    protected function setCompanyFilters(
        SpyCompanyQuery $companyQuery,
        CompanyCriteriaFilterTransfer $companyCriteriaFilterTransfer
    ): SpyCompanyQuery {
        if ($companyCriteriaFilterTransfer->getIdCompany()) {
            $companyQuery->filterByIdCompany($companyCriteriaFilterTransfer->getIdCompany());
        }

        if ($companyCriteriaFilterTransfer->getCompanyIds()) {
            $companyQuery->filterByIdCompany_In($companyCriteriaFilterTransfer->getCompanyIds());
        }

        $name = $companyCriteriaFilterTransfer->getName();

        if ($name !== null && $name !== '') {
            $companyQuery->filterByName(sprintf('%%%s%%', $name), Criteria::LIKE);
            $companyQuery->setIgnoreCase(true);
        }

        $filterTransfer = $companyCriteriaFilterTransfer->getFilter();

        if ($filterTransfer === null) {
            return $companyQuery;
        }

        if ($filterTransfer->getLimit()) {
            $companyQuery->limit($filterTransfer->getLimit());
        }

        if ($filterTransfer->getOffset()) {
            $companyQuery->offset($filterTransfer->getOffset());
        }

        return $companyQuery;
    }
}
