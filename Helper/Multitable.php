<?php

namespace DataObject\Helper;

use DataObject\Factory;

trait Multitable
{
	/**
	 * Returns prefix for fields without aliases
	 *
	 * @return	string
	 */
	final protected function multitableDefaultPrefix()
	{
		return '_default';
	}

	/**
	 * Adds prefix with table name to given fields
	 *
	 * @param	string	$sTable		table name
	 * @param	array	$aFields	array with field names
	 * @return	array
	 */
	protected function multitablePrefixAdd($sPrefix, &$aFields)
	{
		$aResult = [];

		foreach($aFields as &$sField)
		{
			$aResult[$sPrefix .'.'. $sField] = $sPrefix .'.'. $sField;
		}

		return $aResult;
	}

	/**
	 * Remove prefixes from data
	 *
	 * @param	array	$aData	data to format
	 * @return	array
	 */
	protected function multitablePrefixRemove($aData)
	{
		$aResult = [];
		$sDefault = $this->multitableDefaultPrefix();

		foreach($aData as $sField => $mValue)
		{
			$iPos = strpos($sField, '.');

			if($iPos === false)
			{
				$aResult[$sDefault][$sField] = $mValue;
			}
			else
			{
				$sTable = substr($sField, 0, $iPos);
				$sField = substr($sField, $iPos + 1);

				$aResult[$sTable][$sField] = $mValue;
			}
		}

		return $aResult;
	}
}
