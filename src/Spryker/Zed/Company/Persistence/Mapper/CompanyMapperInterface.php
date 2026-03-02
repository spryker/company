<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Company\Persistence\Mapper;

use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Orm\Zed\Company\Persistence\SpyCompany;
use Propel\Runtime\Collection\Collection;

interface CompanyMapperInterface
{
    public function mapCompanyTransferToEntity(
        CompanyTransfer $companyTransfer,
        SpyCompany $spyCompany
    ): SpyCompany;

    public function mapEntityToCompanyTransfer(
        SpyCompany $spyCompany,
        CompanyTransfer $companyTransfer
    ): CompanyTransfer;

    public function mapCompanyEntityCollectionToCompanyCollectionTransfer(
        Collection $companyEntities
    ): CompanyCollectionTransfer;
}
