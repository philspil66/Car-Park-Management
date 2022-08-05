<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\CategoryLangModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Classes\Category;

class CategoryController extends EstController
{
    /**
     * For setting up add / edit category form
     *
     * @return void
     */

    public function addAmendForm() {

    	$categoryId = Input::get('id');
    	$addAmendForm = array();

    	try {

    		if( $categoryId ){	// edit

	    		$Category = CategoryModel::find( $categoryId);

	    		$addAmendForm['mode'] 			= 'Edit';
	    		$addAmendForm['categoryId']		= $Category->id;
	    		$addAmendForm['description'] 	= $Category->lang->description;
	    		$addAmendForm['type'] 			= $Category->type;

	    	}
	    	else { // add

	    		$addAmendForm['mode'] 			= 'Add';
                $addAmendForm['description']    = '';
	    		$addAmendForm['type'] 			= '';

	    	}

    	} catch (\Exception $ex) {

            \Log::info('Error in Add / Amend Form (Categories). '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
            Session::flash('error', 'Error in Add / Amend Form (Categories).');
            die($ex->getMessage());

        }

        return view('admin.categories.categories-add-edit', compact('addAmendForm'));

    }

     /**
     * Add / Edit a category to DB
     *
     * @return void
     */

     public function addAmendCategory(){

        $validator = Category::validateAddEditCategoryInput( Input::all() );

        if ( $validator->fails() ) {

            return Redirect::back()->withInput()->withErrors($validator);

        }

        try {

            $categoryId = Input::get('category_id');

            if( $categoryId ){  // edit category

                $Category                    = CategoryModel::find( $categoryId );
                $Category->type              = Input::get('category_type');
                $Category->slug              = Category::createCategorySlug(Input::get('category_description'));
                $Category->lang->description = Input::get('category_description');
                $Category->save();
                $Category->lang->save();

                Session::flash('success', 'Category has been updated successfully.');
                return Redirect::to('/admin/categories');

            }
            else { // add category

                $Category           = new CategoryModel();
                $Category->type     = Input::get('category_type');
                $Category->slug     = Category::createCategorySlug( Input::get('category_description') );
                $Category->save();

                $CategoryLang               = new CategoryLangModel();
                $CategoryLang->category_id  = $Category->id;
                $CategoryLang->description  = Input::get('category_description');
                $CategoryLang->save();

                Session::flash('success', 'Category has been added successfully.');
                return Redirect::to('/admin/categories');

            }

        } catch (\Exception $ex) {

            \Log::info('Error in Add / Amend Category. '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
            Session::flash('error', 'Error in Add / Amend Category.');
            die($ex->getMessage());

        }

     }

}
