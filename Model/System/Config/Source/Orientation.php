<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023 JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\HyvaPwa\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Orientation
 * @package Jajuma\HyvaPwa\Model\System\Config\Source
 */
class Orientation implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->toArray() as $value => $label) {
            $options[] = ["value" => $value, "label" => $label];
        }

        return $options;
    }

    /**
     * Get options in "key=>value" format.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            "any" => __("Any"),
            "natural" => __("Natural"),
            "portrait" => __("Portrait"),
            "landscape" => __("Landscape"),
        ];
    }
}
