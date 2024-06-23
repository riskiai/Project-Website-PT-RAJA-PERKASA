<?php

namespace App\Observers;

use App\Models\Document_Kerjasama_Client;
use App\Models\User;

class DocumentKerjasamaClientObserver
{
    /**
     * Handle the Document_Kerjasama_Client "updated" event.
     */
    public function updated(Document_Kerjasama_Client $document_Kerjasama_Client): void
    {
        if ($document_Kerjasama_Client->status_kerjasama == 'diterima') {
            // Update status_pic_perusahaan
            $user = $document_Kerjasama_Client->user;
            if ($user && $user->status_pic_perusahaan !== 'client') {
                $user->update(['status_pic_perusahaan' => 'client']);
            }
        }
    }

    /**
     * Handle the Document_Kerjasama_Client "deleted" event.
     */
    public function deleted(Document_Kerjasama_Client $document_Kerjasama_Client): void
    {
        //
    }

    /**
     * Handle the Document_Kerjasama_Client "restored" event.
     */
    public function restored(Document_Kerjasama_Client $document_Kerjasama_Client): void
    {
        //
    }

    /**
     * Handle the Document_Kerjasama_Client "force deleted" event.
     */
    public function forceDeleted(Document_Kerjasama_Client $document_Kerjasama_Client): void
    {
        //
    }
}
