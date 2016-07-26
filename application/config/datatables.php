<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CI Datatables
 *
 * Datatables library for Codeigniter
 *
 * @package   CI Datatables
 * @author    Paul Zepernick and contributors
 * @copyright 2015 Paul Zepernick and Github contributors
 * @link      http://www.macpczone.co.uk
 * @license   MIT
 * @version   3.0
 */

// Datatables currency setting
$config['datatables.currency'] = '£';

// Default is implied root directory/themes/
$config['datatables.date_format'] = 'D jS F, Y \a\t g:ia';

// Datatables action. The double brackets are replaced by Codeigniters site_url() function
// and the double @ symbols are replaced by the value for the particular columns row.
$config['datatables.action1'] = '<a href="{{example/read/@@}}" target="_blank" class="view-btn">VIEW</a>&nbsp;|&nbsp;<a href="{{example/update/@@}}" target="_blank" class="edit-btn">EDIT</a>&nbsp;|&nbsp;<a href="{{example/delete/@@}}" target="_blank" class="delete-btn">DELETE</a>';

// Same as the above action, you can add some more if you want to;
$config['datatables.action2'] = NULL;
