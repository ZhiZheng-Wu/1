<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\property;
use Authorization\IdentityInterface;

/**
 * property policy
 */
class propertyPolicy
{
    /**
     * Check if $user can add property
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\property $property
     * @return bool
     */
    public function canAdd(IdentityInterface $user, property $property)
    {
        if (
            ($this->isEmployee($user)) ||
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

    /**
     * Check if $user can edit property
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\property $property
     * @return bool
     */
    public function canEdit(IdentityInterface $user, property $property)
    {
        if (
            ($this->isEmployee($user)) ||
            ($this->isLandlordSelf($user, $property))
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
     * Check if $user can delete property
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\property $property
     * @return bool
     */
    public function canDelete(IdentityInterface $user, property $property)
    {
        if (
            ($this->isEmployee($user)) ||
            ($this->isLandlordSelf($user, $property))
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
     * Check if $user can view property
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\property $property
     * @return bool
     */
    public function canView(IdentityInterface $user, property $property)
    {
        if (
            ($this->isEmployee($user)) ||
            ($this->isLandlordSelf($user, $property))
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
    public function canIndex(IdentityInterface $user, property $property)
    {
        if (
            ($this->isEmployee($user)) ||
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
        Can view properties only
        */
        if( ('tenant' === $user->get('role')) && ($this->siteAccess($user)) )
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
    protected function isLandlordSelf(IdentityInterface $user, property $property)
    {
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
