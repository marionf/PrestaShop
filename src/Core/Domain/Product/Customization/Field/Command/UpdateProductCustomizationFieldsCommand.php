<?php
/**
 * 2007-2020 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Core\Domain\Product\Customization\Field\Command;

use PrestaShop\PrestaShop\Core\Domain\Product\Customization\Field\CustomizationField;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;

/**
 * Updates product customization fields
 */
class UpdateProductCustomizationFieldsCommand
{
    /**
     * @var ProductId
     */
    private $productId;

    /**
     * @var CustomizationField[]
     */
    private $customizationFields;

    /**
     * @param int $productId
     * @param array $customizationFields
     */
    public function __construct(int $productId, array $customizationFields)
    {
        $this->productId = new ProductId($productId);
        $this->setCustomizationFields($customizationFields);
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return CustomizationField[]
     */
    public function getCustomizationFields(): array
    {
        return $this->customizationFields;
    }

    /**
     * @param array $customizationFields
     */
    private function setCustomizationFields(array $customizationFields): void
    {
        foreach ($customizationFields as $customizationField) {
            $byModule = isset($customizationField['added_by_module']) ? (bool) $customizationField['added_by_module'] : false;

            $this->customizationFields[] = new CustomizationField(
                isset($customizationField['id']) ? (int) $customizationField['id'] : null,
                (int) $customizationField['type'],
                $customizationField['localized_names'],
                (bool) $customizationField['required'],
                $byModule
            );
        }
    }
}
