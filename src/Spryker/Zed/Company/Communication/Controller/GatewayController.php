<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Company\Communication\Controller;

use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Spryker\Zed\Company\Business\CompanyFacadeInterface getFacade()
 * @method \Spryker\Zed\Company\Persistence\CompanyRepositoryInterface getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    public function createAction(CompanyTransfer $companyTransfer): CompanyResponseTransfer
    {
        return $this->getFacade()->create($companyTransfer);
    }

    public function getCompanyByIdAction(CompanyTransfer $companyTransfer): CompanyTransfer
    {
        return $this->getFacade()->getCompanyById($companyTransfer);
    }

    public function findCompanyByUuidAction(CompanyTransfer $companyTransfer): CompanyResponseTransfer
    {
        return $this->getFacade()->findCompanyByUuid($companyTransfer);
    }

    public function getCompanyCollectionAction(CompanyCriteriaFilterTransfer $companyCriteriaFilterTransfer): CompanyCollectionTransfer
    {
        return $this->getFacade()->getCompanyCollection($companyCriteriaFilterTransfer);
    }
}
