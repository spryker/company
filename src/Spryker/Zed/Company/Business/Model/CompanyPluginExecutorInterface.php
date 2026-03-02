<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Company\Business\Model;

use Generated\Shared\Transfer\CompanyResponseTransfer;

interface CompanyPluginExecutorInterface
{
    public function executeCompanyPreSavePlugins(CompanyResponseTransfer $companyResponseTransfer): CompanyResponseTransfer;

    public function executeCompanyPostSavePlugins(CompanyResponseTransfer $companyResponseTransfer): CompanyResponseTransfer;

    public function executeCompanyPostCreatePlugins(CompanyResponseTransfer $companyResponseTransfer): CompanyResponseTransfer;
}
