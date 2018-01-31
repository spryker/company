<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Company\Dependency\Plugin;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyPreSavePluginInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function preSave(CompanyTransfer $companyTransfer): CompanyTransfer;
}