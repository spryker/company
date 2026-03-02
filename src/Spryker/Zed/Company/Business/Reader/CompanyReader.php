<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Company\Business\Reader;

use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Company\Persistence\CompanyRepositoryInterface;

class CompanyReader implements CompanyReaderInterface
{
    /**
     * @var \Spryker\Zed\Company\Persistence\CompanyRepositoryInterface
     */
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function findCompanyByUuid(CompanyTransfer $companyTransfer): CompanyResponseTransfer
    {
        $companyTransfer->requireUuid();

        $companyTransfer = $this->companyRepository->findCompanyByUuid(
            $companyTransfer->getUuid(),
        );

        $companyResponseTransfer = new CompanyResponseTransfer();
        if (!$companyTransfer) {
            return $companyResponseTransfer->setIsSuccessful(false);
        }

        return $companyResponseTransfer
            ->setIsSuccessful(true)
            ->setCompanyTransfer($companyTransfer);
    }
}
