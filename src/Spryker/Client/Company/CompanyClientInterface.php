<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Company;

use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyClientInterface
{
    /**
     * Specification:
     * - Creates new company.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyResponseTransfer
     */
    public function createCompany(CompanyTransfer $companyTransfer): CompanyResponseTransfer;

    /**
     * Specification:
     *  - Retrieve a company by CompanyTransfer::idCompany in the transfer
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function getCompanyById(CompanyTransfer $companyTransfer): CompanyTransfer;

    /**
     * Specification:
     * - Finds a company by uuid.
     * - Makes zed request.
     * - Requires uuid field to be set in CompanyTransfer taken as parameter.
     *
     * @api
     *
     * {@internal will work if UUID field is provided.}
     *
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyResponseTransfer
     */
    public function findCompanyByUuid(CompanyTransfer $companyTransfer): CompanyResponseTransfer;

    /**
     * Specification:
     * - Retrieves a collection of companies filtered by criteria from Persistence.
     * - Makes Zed request.
     * - Uses `CompanyCriteriaFilterTransfer.idCompany` to filter by a specific company ID.
     * - Uses `CompanyCriteriaFilterTransfer.companyIds` to filter by multiple company IDs.
     * - Uses `CompanyCriteriaFilterTransfer.name` to filter companies by name (case-insensitive partial match).
     * - Uses `CompanyCriteriaFilterTransfer.filter.limit` to limit the number of results.
     * - Returns `CompanyCollectionTransfer` containing filtered company data.
     * - Returns an empty collection if no companies match the criteria.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyCriteriaFilterTransfer $companyCriteriaFilterTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function getCompanyCollection(CompanyCriteriaFilterTransfer $companyCriteriaFilterTransfer): CompanyCollectionTransfer;
}
