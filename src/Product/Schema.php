<?php

namespace Vitalybaev\GoogleMerchant\Product;

class Schema
{
    const MAP = array(
    	'adult' => array(
		'https://schema.org/AlcoholConsideration'                     => true,
		'https://schema.org/DangerousGoodConsideration'               => true,
		'https://schema.org/HealthcareConsideration'                  => true,
		'https://schema.org/NarcoticConsideration'                    => true,
		'https://schema.org/ReducedRelevanceForChildrenConsideration' => true,
		'https://schema.org/SexualContentConsideration'               => true,
		'https://schema.org/TobaccoNicotineConsideration'             => true,
		'https://schema.org/UnclassifiedAdultConsideration'           => true,
		'https://schema.org/ViolenceConsideration'                    => true,
		'https://schema.org/WeaponConsideration'                      => true,
	),
	'availability' => array(
		'https://schema.org/BackOrder'           => 'backorder',
		'https://schema.org/Discontinued'        => 'out_of_stock',
		'https://schema.org/InStock'             => 'in_stock',
		'https://schema.org/InStoreOnly'         => 'in_stock',
		'https://schema.org/LimitedAvailability' => 'in_stock',
		'https://schema.org/OnlineOnly'          => 'in_stock',
		'https://schema.org/OutOfStock'          => 'out_of_stock',
		'https://schema.org/PreOrder'            => 'preorder',
		'https://schema.org/PreSale'             => 'preorder',
		'https://schema.org/SoldOut'             => 'out_of_stock',
	),
	'condition' => array(
		'https://schema.org/DamagedCondition'     => 'used',
		'https://schema.org/NewCondition'         => 'new',
		'https://schema.org/RefurbishedCondition' => 'refurbished',
		'https://schema.org/UsedCondition'        => 'used',
	),
	'energy_efficiency_class' => array(
		'https://schema.org/EUEnergyEfficiencyCategoryA3Plus' => 'A+++',
		'https://schema.org/EUEnergyEfficiencyCategoryA2Plus' => 'A++',
		'https://schema.org/EUEnergyEfficiencyCategoryA1Plus' => 'A+',
		'https://schema.org/EUEnergyEfficiencyCategoryA'      => 'A',
		'https://schema.org/EUEnergyEfficiencyCategoryB'      => 'B',
		'https://schema.org/EUEnergyEfficiencyCategoryC'      => 'C',
		'https://schema.org/EUEnergyEfficiencyCategoryD'      => 'D',
		'https://schema.org/EUEnergyEfficiencyCategoryE'      => 'E',
		'https://schema.org/EUEnergyEfficiencyCategoryF'      => 'F',
		'https://schema.org/EUEnergyEfficiencyCategoryG'      => 'G',
	),
	'size_type' => array(
		'https://schema.org/WearableSizeGroupRegular'   => 'regular',
		'https://schema.org/WearableSizeGroupPetite'    => 'petite',
		'https://schema.org/WearableSizeGroupPlus'      => 'plus',
		'https://schema.org/WearableSizeGroupTall'      => 'tall',
		'https://schema.org/WearableSizeGroupBig'       => 'big',
		'https://schema.org/WearableSizeGroupMaternity' => 'maternity',
	),
	'size_system' => array(
		'https://schema.org/WearableSizeSystemAU'     => 'AU',
		'https://schema.org/WearableSizeSystemBR'     => 'BR',
		'https://schema.org/WearableSizeSystemCN'     => 'CN',
		'https://schema.org/WearableSizeSystemDE'     => 'DE',
		'https://schema.org/WearableSizeSystemEurope' => 'EU',
		'https://schema.org/WearableSizeSystemFR'     => 'FR',
		'https://schema.org/WearableSizeSystemIT'     => 'IT',
		'https://schema.org/WearableSizeSystemJP'     => 'JP',
		'https://schema.org/WearableSizeSystemMX'     => 'MEX',
		'https://schema.org/WearableSizeSystemUK'     => 'UK',
		'https://schema.org/WearableSizeSystemUS'     => 'US',
	),
    );
}
