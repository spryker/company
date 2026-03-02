<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Company\Persistence;

use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\Company\Persistence\SpyCompanyStoreQuery;
use Spryker\Zed\Company\Persistence\Mapper\CompanyMapper;
use Spryker\Zed\Company\Persistence\Mapper\CompanyMapperInterface;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Spryker\Zed\Company\CompanyConfig getConfig()
 * @method \Spryker\Zed\Company\Persistence\CompanyEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\Company\Persistence\CompanyRepositoryInterface getRepository()
 */
class CompanyPersistenceFactory extends AbstractPersistenceFactory
{
    public function createCompanyQuery(): SpyCompanyQuery
    {
        return SpyCompanyQuery::create();
    }

    public function createCompanyStoreQuery(): SpyCompanyStoreQuery
    {
        return SpyCompanyStoreQuery::create();
    }

    public function createCompanyMapper(): CompanyMapperInterface
    {
        return new CompanyMapper();
    }
}
