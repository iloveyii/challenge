<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\helpers;

use yii\helpers\BaseArrayHelper;
/**
 * ArrayHelper provides additional array functionality that you can use in your
 * application.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ArrayHelper extends BaseArrayHelper
{
	/**
	 * Segregate rows by field name
	 *
	 * Different than map because if returns one dimensional associate array of col1=>col2
	 * But segregate returns array of rows grouped by columns
	 *
	 * @param  array $rows array of arrays
	 * @param mixed $columns if string then it makes any array from values in that column, if array then it groups by array values
	 *
	 * @return array
	 */
	public static function segregate($rows, $columns)
	{

		if (is_array($columns)) {
			$segregated = $columns;
		} else {
			$segregated = array_flip(self::map($rows, null, $columns));
		}

		foreach ($rows as $row) {
			if( isset($segregated[$row['parser']]) ) {
				if ( ! is_array($segregated[$row['parser']]) ) {
					$segregated[$row['parser']] = [];
				}
				array_push($segregated[$row['parser']], $row);
			}
		}

		return $segregated;
	}

	/**
	 * @inheritdoc
	 */
	public static function map($array, $from, $to, $group = null)
	{
		$result = [];
		$counter = 0;

		foreach ($array as $element) {
			$key = is_null($from) ? $counter++ : static::getValue($element, $from);
			$value = static::getValue($element, $to);
			if ($group !== null) {
				$result[static::getValue($element, $group)][$key] = $value;
			} else {
				$result[$key] = $value;
			}
		}

		return $result;
	}

}
