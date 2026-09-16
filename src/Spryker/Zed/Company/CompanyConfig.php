<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Company;

use Generated\Shared\Transfer\CompanyTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CompanyConfig extends AbstractBundleConfig
{
    /**
     * Specification:
     * - Maps a sortable `CompanyTransfer` property onto the column the sort is applied to.
     * - A sort field absent from the map is ignored by the repository.
     *
     * @api
     *
     * @return array<string, string>
     */
    public function getCompanyCollectionSortableFieldMap(): array
    {
        return [
            CompanyTransfer::NAME => SpyCompanyTableMap::COL_NAME,
            CompanyTransfer::STATUS => SpyCompanyTableMap::COL_STATUS,
            CompanyTransfer::IS_ACTIVE => SpyCompanyTableMap::COL_IS_ACTIVE,
        ];
    }
}
