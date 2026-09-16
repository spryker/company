<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\Company\Business\CompanyFacade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\Company\Communication\Plugin\CompanyUser\CompanyExistsCompanyUserSavePreCheckPlugin;
use SprykerTest\Zed\Company\CompanyBusinessTester;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group Company
 * @group Business
 * @group CompanyFacade
 * @group CompanyUserValidatorTest
 * Add your own group annotations below this line
 */
class CompanyUserValidatorTest extends Unit
{
    protected const int ID_NON_EXISTENT_COMPANY = 0;

    protected CompanyBusinessTester $tester;

    public function testAcceptsAnExistingCompany(): void
    {
        // Arrange
        $companyTransfer = $this->tester->haveCompany();

        $companyUserTransfer = (new CompanyUserTransfer())
            ->setFkCompany($companyTransfer->getIdCompany());

        // Act
        $companyUserResponseTransfer = (new CompanyExistsCompanyUserSavePreCheckPlugin())
            ->check($companyUserTransfer);

        // Assert
        $this->assertTrue($companyUserResponseTransfer->getIsSuccessful());
    }

    public function testRejectsANonExistentCompany(): void
    {
        // Arrange
        $companyUserTransfer = (new CompanyUserTransfer())
            ->setFkCompany(static::ID_NON_EXISTENT_COMPANY);

        // Act
        $companyUserResponseTransfer = (new CompanyExistsCompanyUserSavePreCheckPlugin())
            ->check($companyUserTransfer);

        // Assert
        $this->assertFalse($companyUserResponseTransfer->getIsSuccessful());
        $this->assertNotEmpty($companyUserResponseTransfer->getMessages());
    }

    public function testLeavesACompanyUserWithoutACompanyToThePersistenceConstraint(): void
    {
        // Arrange
        $companyUserTransfer = new CompanyUserTransfer();

        // Act
        $companyUserResponseTransfer = (new CompanyExistsCompanyUserSavePreCheckPlugin())
            ->check($companyUserTransfer);

        // Assert
        $this->assertTrue($companyUserResponseTransfer->getIsSuccessful());
    }
}
