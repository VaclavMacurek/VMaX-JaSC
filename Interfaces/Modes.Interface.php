<?php

namespace JaSC;

/**
 * @package VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2016 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * interface with modes for inserting of values
 */
interface I_JaSC_Modes
{
	/**
	 * values are inserted from right to left
	 */
	const JASC_MODE_RTLINS = 'RIGHT_TO_LEFT_INSERT';
	/**
	 * values are inserted from left to right
	 */
	const JASC_MODE_LTRINS = 'LEFT_TO_RIGHT_INSERT';
	/**
	 * values are not inserted
	 */
	const JASC_MODE_NOINS = 'NO_INSERT';
}
