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

class CompanyMapper implements CompanyMapperInterface
{
    public function mapCompanyTransferToEntity(
        CompanyTransfer $companyTransfer,
        SpyCompany $spyCompany
    ): SpyCompany {
        $spyCompany->fromArray(
            $companyTransfer->modifiedToArray(false),
        );

        return $spyCompany;
    }

    public function mapEntityToCompanyTransfer(
        SpyCompany $spyCompany,
        CompanyTransfer $companyTransfer
    ): CompanyTransfer {
        return $companyTransfer->fromArray(
            $spyCompany->toArray(),
            true,
        );
    }

    /**
     * @param \Propel\Runtime\Collection\Collection<\Orm\Zed\Company\Persistence\SpyCompany> $companyEntities
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function mapCompanyEntityCollectionToCompanyCollectionTransfer(
        Collection $companyEntities
    ): CompanyCollectionTransfer {
        $companyCollectionTransfer = new CompanyCollectionTransfer();

        foreach ($companyEntities as $companyEntity) {
            $companyTransfer = $this->mapEntityToCompanyTransfer(
                $companyEntity,
                new CompanyTransfer(),
            );

            $companyCollectionTransfer->addCompany($companyTransfer);
        }

        return $companyCollectionTransfer;
    }
}
