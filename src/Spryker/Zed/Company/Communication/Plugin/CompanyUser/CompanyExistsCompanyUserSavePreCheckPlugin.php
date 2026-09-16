<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Company\Communication\Plugin\CompanyUser;

use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserSavePreCheckPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\Company\Business\CompanyBusinessFactory getBusinessFactory()
 * @method \Spryker\Zed\Company\CompanyConfig getConfig()
 */
class CompanyExistsCompanyUserSavePreCheckPlugin extends AbstractPlugin implements CompanyUserSavePreCheckPluginInterface
{
    /**
     * {@inheritDoc}
     * - Checks that `CompanyUserTransfer.fkCompany` resolves to an existing company.
     * - Returns an unsuccessful response with a message when the company does not exist.
     * - Returns a successful response when `CompanyUserTransfer.fkCompany` is not set.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    public function check(CompanyUserTransfer $companyUserTransfer): CompanyUserResponseTransfer
    {
        return $this->getBusinessFactory()
            ->createCompanyUserValidator()
            ->validateCompanyExists($companyUserTransfer);
    }
}
