<?php

/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library
include( "../lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'product' )
	->fields(
		Field::inst( 'name' )
			->validator( Validate::notEmpty( ValidateOptions::inst()
				->message( 'Debe de aingresar un nombre' )	
			) ),
		Field::inst( 'price' )
			->validator( Validate::numeric() )
			->setFormatter( Format::ifEmpty(null) ),
		Field::inst( 'available' )
			->validator( Validate::numeric() )
			->setFormatter( Format::ifEmpty(null) )
	)
    ->join(
        Mjoin::inst( 'file' )
            ->link( 'product.idProduct', 'productFile.IdProduct' )
            ->link( 'file.idFile', 'productFile.idFile' )
            ->fields(
                Field::inst( 'idProduct' )
                    ->upload( Upload::inst( $_SERVER['DOCUMENT_ROOT'].'/ecommerce/upload/__ID__.__EXTN__' )
                        ->db( 'file', 'idFile', array(
                            'filename'    => Upload::DB_FILE_NAME,
                            'filesize'    => Upload::DB_FILE_SIZE,
                            'webPath'    => Upload::DB_WEB_PATH,
                            'systemPath' => Upload::DB_SYSTEM_PATH
                        ) )
                        ->validator( Validate::fileSize( 5000000, 'Files must be smaller that 5M' ) )
                        ->validator( Validate::fileExtensions( array( 'webp','png', 'jpg', 'jpeg', 'gif' ), "Please upload an image" ) )
                    )
            )
    )
	->process( $_POST )
	->json();
