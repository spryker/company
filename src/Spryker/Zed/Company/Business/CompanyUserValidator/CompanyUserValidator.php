<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Company\Business\CompanyUserValidator;

use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\ResponseMessageTransfer;
use Spryker\Zed\Company\Persistence\CompanyRepositoryInterface;

class CompanyUserValidator implements CompanyUserValidatorInterface
{
    protected const string GLOSSARY_KEY_ERROR_COMPANY_NOT_FOUND = 'message.company_user.validation.company_not_found';

    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
    ) {
    }

    public function validateCompanyExists(CompanyUserTransfer $companyUserTransfer): CompanyUserResponseTransfer
    {
        $companyUserResponseTransfer = (new CompanyUserResponseTransfer())
            ->setCompanyUser($companyUserTransfer)
            ->setIsSuccessful(true);

        $idCompany = $companyUserTransfer->getFkCompany();

        if ($idCompany === null) {
            return $companyUserResponseTransfer;
        }

        if ($this->companyRepository->findCompanyById($idCompany) !== null) {
            return $companyUserResponseTransfer;
        }

        return $companyUserResponseTransfer
            ->setIsSuccessful(false)
            ->addMessage((new ResponseMessageTransfer())->setText(static::GLOSSARY_KEY_ERROR_COMPANY_NOT_FOUND));
    }
}
