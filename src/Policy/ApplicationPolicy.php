<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\application;
use Authorization\IdentityInterface;

/* Trying to get tbl function */

use Cake\Datasource\FactoryLocator;
//$productsTable = FactoryLocator::get('Table')->get('Products');

/* Try to get function end */


/**
 * application policy
 */
class applicationPolicy
{
    /**
     * Check if $user can add application
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\application $application
     * @return bool
     */
    public function canAdd(IdentityInterface $user, application $application)
    {
        if (
            ($this->isEmployee($user)) ||
            ($this->isTenant($user))
        )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Check if $user can edit application
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\application $application
     * @return bool
     */
    public function canEdit(IdentityInterface $user, application $application)
    {
        if (
            ($this->isEmployee($user)) ||
            ($this->isTenantSelf($user, $application)) ||
            ($this->isLandlordSelf($user, $application))
        )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Check if $user can delete application
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\application $application
     * @return bool
     */
    public function canDelete(IdentityInterface $user, application $application)
    {
        /* Assuming tenant & landlord can only hide/archive/cancel it: not outright delete it */
        if ( ($this->isEmployee($user)) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Check if $user can view application
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\application $application
     * @return bool
     */
    public function canView(IdentityInterface $user, application $application)
    {
        if (
            ($this->isEmployee($user)) ||
            ($this->isTenantSelf($user, $application)) ||
            ($this->isLandlordSelf($user, $application))
        )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /* Additional added */
    public function canIndex(IdentityInterface $user, application $application)
    {
        if  (
            ($this->isEmployee($user)) ||
            ($this->isTenant($user)) ||
            ($this->isLandlord($user))
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
    protected function isTenantSelf(IdentityInterface $user, application $application)
    {
        /*
        Should only be able to edit/add/delete own details
        */
        $curr_user_id = $user->getIdentifier('id');

        $tenantTbl = FactoryLocator::get('Table')->get('Tenants');

        $tenant_user = $tenantTbl->findByUserId($curr_user_id)->first();

        if
        (
            ('tenant' === $user->get('role')) &&
            ($this->siteAccess($user)) &&
            (
                $curr_user_id === $tenant_user->user_id
            ) &&
            (
                $tenant_user->id === $application->tenant_id
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
    protected function isLandlordSelf(IdentityInterface $user, application $application)
    {
        $propertyTbl = FactoryLocator::get('Table')->get('Properties');
        $property = $propertyTbl->findById($application->property_id)->first();
        if(
            ($this->isLandlord($user)) &&
            ($user->getIdentifier() === $property->user_id)
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
      return false; // Disabling access to the page - not used this iteration
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
