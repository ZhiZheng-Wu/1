<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\TenancyHistory;
use Authorization\IdentityInterface;
/* Trying to get tbl function */

use Cake\Datasource\FactoryLocator;
//$productsTable = FactoryLocator::get('Table')->get('Products');

/* Try to get function end */

//use Cake\ORM\Table;
//use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * TenancyHistory policy
 */
class TenancyHistoryPolicy
{
    /**
     * Check if $user can add TenancyHistory
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\TenancyHistory $tenancyHistory
     * @return bool
     */
    public function canAdd(IdentityInterface $user, TenancyHistory $tenancyHistory)
    {
        if (
            ($this->isEmployee($user))
        )
        {
            return false; // Currently disabling access since no longer used this way
        }
        else
        {
            return false;
        }
    }

    /**
     * Check if $user can edit TenancyHistory
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\TenancyHistory $tenancyHistory
     * @return bool
     */
    public function canEdit(IdentityInterface $user, TenancyHistory $tenancyHistory)
    {
        if (
            ($this->isEmployee($user))
        )
        {
            return false; // Currently disabling access since no longer used this way
        }
        else
        {
            return false;
        }
    }

    /**
     * Check if $user can delete TenancyHistory
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\TenancyHistory $tenancyHistory
     * @return bool
     */
    public function canDelete(IdentityInterface $user, TenancyHistory $tenancyHistory)
    {
        if (
            ($this->isEmployee($user))
        )
        {
            return false; // Currently disabling access since no longer used this way
        }
        else
        {
            return false;
        }
    }

    /**
     * Check if $user can view TenancyHistory
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\TenancyHistory $tenancyHistory
     * @return bool
     */
    public function canView(IdentityInterface $user, TenancyHistory $tenancyHistory)
    {
        if (
            ($this->isEmployee($user))
        )
        {
            return false; // Currently disabling access since no longer used this way
        }
        else
        {
            return false;
        }
    }

    /* Additional added */
    public function canIndex(IdentityInterface $user, TenancyHistory $tenancyHistory)
    {
        /* Assuming front end doesn't return other tenants info when user is a tenant */
        if (
            ($this->isEmployee($user))
        )
        {
            return false; // Currently disabling access since no longer used this way
        }
        else
        {
            return false;
        }
    }
    public function canEmployee(IdentityInterface $user)
    {
        if ( $this->isEmployee($user) )
        {
            return false; // Currently disabling access since no longer used this way
        }
        else
        {
            return false;
        }
    }
    public function canUpload(IdentityInterface $user)
    {
        if (
            // ($this->isEmployee($user)) || // Since uploads implementation takes current user ID
            ($this->isTenant($user)) // Assumes that ID always gotten via the controller: controlled by server, & cannot view others files from uploads
        )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    /* Role checker functions */
    protected function isAdmin(IdentityInterface $user)
    {
        if( ('admin' === $user->get('role')) && ($this->siteAccess($user)) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    protected function isStaff(IdentityInterface $user)
    {
        if( ('staff' === $user->get('role')) && ($this->siteAccess($user)) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    protected function isEmployee(IdentityInterface $user)
    {
        /* Is the user a admin/staff */
        if(
            ($this->isAdmin($user)) ||
            ($this->isStaff($user))
        )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    protected function isTenant(IdentityInterface $user)
    {
        /*
        Should only be able to edit/add/delete own details
        */
        if(
            ('tenant' === $user->get('role')) &&
            ($this->siteAccess($user))
        )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    protected function isTenantSelf(IdentityInterface $user, TenancyHistory $tenancyHistory)
    {
        /*
        Should only be able to edit/add/delete own details
        */
        $curr_user_id = $user->getIdentifier('id');

        //debug(get(TenacyHistory)); exit;
        // debug($curr_user_id); exit;

        $tenantTbl = FactoryLocator::get('Table')->get('Tenants');

        $tenant_user = $tenantTbl->findByUserId($curr_user_id)->first(); //$this->TenancyHistory->Tenants->findByUserId(curr_user_id)->first();

        if
        (
            ('tenant' === $user->get('role')) &&
            ($this->siteAccess($user)) &&
            (
                $curr_user_id === $tenant_user->user_id
            ) &&
            (
                $tenant_user->id === $tenancyHistory->tenant_id
            )
        )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    protected function isLandlord(IdentityInterface $user)
    {
        if( ('landlord' === $user->get('role')) && ($this->siteAccess($user)) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    protected function isLandlordSpecial(IdentityInterface $user, TenancyHistory $tenancyHistory)
    {
        /*
        Landlord is only allowed to see tenant history info if it's related tenant isn't set to hidden here
        */
        $tenant_user = $tenancyHistory->tenant_id;
        $tenantTbl = FactoryLocator::get('Table')->get('Tenants');
        //debug($tenant_user); exit;
        $tenant_record = $tenantTbl->findById($tenant_user)->first();
        //debug($tenant_record); exit;
        if
        (
            ($this->isLandlord($user)) &&
            ($tenant_record->hidden === FALSE)
        )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    protected function siteAccess(IdentityInterface $user)
    {
        if(True === $user->get('site_access'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
