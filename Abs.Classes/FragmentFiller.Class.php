<?php

namespace JaSC;

use UniCAT\MethodScope;
use UniCAT\CodeExport;
use UniCAT\Comments;

/**
 * @package VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2017 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * class for better generation of fragments
 */
abstract class FragmentFiller
{
	use CodeExport,
	Comments;

	/**
	 * keeps all texts (variables' names and values) inserted into fragments;
	 * probably could have better name
	 * 
	 * @var array 
	 */
	protected $Insertions = array();
	/**
	 * class name;
	 * rewritten in used function - to real class name
	 * 
	 * @var string class name
	 */
	protected $Class = __CLASS__;

	/**
	 * sets insertions (texts filled into fragment)
	 * 
	 * @param string $Insertions texts inserted into fragment (variables' names and values)
	 * 
	 * @throws Exception
	 */
	public function __construct(...$Insertions)
	{
		$InsertionNumber = 0;

		try
		{
			foreach( $Insertions as $Insertion )
			{
				if( !Core::Check_IsScalar($Insertion) )
				{
					throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
				}

				$InsertionNumber++;
			}

			$this -> Insertions = $Insertions;
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), $Exception -> Get_CallerFunctionName(), MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__, $InsertionNumber), gettype(MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__)[$ArgumentNumber]), Core::ShowOptions_Scalar());
		}
	}

}
