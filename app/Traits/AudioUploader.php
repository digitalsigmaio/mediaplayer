<?php
/**
 * User: Manson
 * Date: 6/27/2018
 * Time: 2:54 PM
 */

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait AudioUploader
{
    public $audioPath = 'audio';

    /**
     * Stores audio in storage/app/public/audio
     * and returns hashed file name
     *
     * @param UploadedFile $file
     *
     * @return string
     */
    public function uploadAudio( UploadedFile $file ): string
    {
        return $file->storeAs( $this->audioPath, $this->hashFileName( $file ) );
    }

    /**
     * Replace an existing audio with a new one
     * and return the file name of the new audio
     *
     * @param UploadedFile $file
     * @param string $oldFileName
     *
     * @return string
     * @throws \Exception
     */
    public function updateAudio( UploadedFile $file, string $oldFileName ): string
    {
        if ( Storage::disk( config( 'filesystems.default' ) )->exists( $oldFileName ) ) {
            if ( $this->deleteAudio( $oldFileName ) ) {
                return $this->uploadAudio( $file );
            }
            throw new \Exception('Failed to delete old audio');
        }
        return $this->uploadAudio( $file );
    }

    /**
     * Delete audio from storage/app/public/audio
     *
     * @param string $fileName
     *
     * @return bool
     */
    public function deleteAudio( string $fileName ): bool
    {
        if ( Storage::disk( config( 'filesystems.default' ) )->exists( $fileName ) ) {
            return Storage::delete( $fileName );
        }
        return false;
    }

    /**
     * Return an http response with the raw file
     *
     * @param string $fileName
     *
     * @return mixed
     */
    public function downloadAudio( string $fileName )
    {
        return Storage::download( $fileName );
    }

    /**
     * Get the full audio url
     *
     * @param string $fileName
     *
     * @return string
     */
    public function getAudioUrl( ?string $fileName ): string
    {
        return $fileName ? Storage::url($fileName) : '';
    }

    /**
     * @param UploadedFile $file
     *
     * @return string
     */
    protected function hashFileName( UploadedFile $file ): string
    {
        return Str::random( 40 ) . '.' . $file->getClientOriginalExtension();
    }
}