<?php

namespace App\Repositories\Main\Beneficiary;


interface BeneficiaryInterface {

    /*
     * Return all beneficiaries
     */
    public function getAll();

    /*
     * Find a beneficiary
    */
    public function find($id);

    /*
     * Delete a beneficiary
    */
    public function delete($id);

}
