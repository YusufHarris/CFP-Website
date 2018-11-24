<?php

namespace App\Repositories\Main\Beneficiary;

use App\Repositories\Main\Beneficiary\BeneficiaryInterface as BeneficiaryInterface;
use App\Models\Main\Beneficiary;


class BeneficiaryRepository implements BeneficiaryInterface
{

    /*
     * Return all beneficiaries
     */
    public function getAll()
    {
        return Beneficiary::all();
    }

    /*
     * Find a beneficiary
    */
    public function find($id)
    {
        return Beneficiary::findOrFail($id);
    }

    /*
     * Delete a beneficiary
    */
    public function delete($id)
    {
        return Beneficiary::find($id)->delete();
    }

}
