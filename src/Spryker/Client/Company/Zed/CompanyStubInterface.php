<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Company\Zed;

use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyStubInterface
{
    public function createCompany(CompanyTransfer $companyTransfer): CompanyResponseTransfer;

    public function getCompanyById(CompanyTransfer $companyTransfer): CompanyTransfer;

    public function findCompanyByUuid(CompanyTransfer $companyTransfer): CompanyResponseTransfer;

    public function getCompanyCollection(CompanyCriteriaFilterTransfer $companyCriteriaFilterTransfer): CompanyCollectionTransfer;
}
