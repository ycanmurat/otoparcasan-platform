<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getGiftType($id)
{
	if ($id == 0) {
		return 'Herkes';
	}elseif ($id == 1) {
		return 'Kullanıcıya Özel';
	}elseif ($id == 2) {
		return 'ülkeye Özel';
	}
}

function getGiftTypeColor($id)
{
	if ($id == 0) {
		return 'info';
	}elseif ($id == 1) {
		return 'warning';
	}elseif ($id == 2) {
		return 'primary';
	}
}

function getDiscountType($id)
{
	if ($id == 1) {
		return 'Direkt';
	}elseif ($id == 2) {
		return 'Yüzde';
	}
}

function getDiscountTypeColor($id)
{
	if ($id == 1) {
		return 'info';
	}elseif ($id == 2) {
		return 'warning';
	}
}