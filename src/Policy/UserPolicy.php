<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\user;
use Authorization\IdentityInterface;

/**
 * user policy
 */
class userPolicy
{
    /**
     * Check if $user can add user
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\user $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, user $resource)
    {
        // Currently, staff can add other staff & admins
        if ( $this->isAdmin($user) || ($this->isStaffSpecial($user, $resource)) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Check if $user can edit user
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\user $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, user $resource)
    {
        if (
            ($this->isAdmin($user)) ||
            ($this->isStaffSpecial($user, $resource)) ||
            ($this->isTenantSelf($user, $resource)) ||
            ($this->isLandlordSelf($user,$resource))
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
     * Check if $user can delete user
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\user $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, user $resource)
    {
        if (
            ($this->isAdmin($user)) ||
            ($this->isStaffSpecial($user, $resource))||
            ($this->isTenantSelf($user, $resource)) ||
            ($this->isLandlordSelf($user, $resource))

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
     * Check if $user can view user
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\user $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, user $resource)
    {
        if (
            ($this->isEmployee($user)) ||
            ($this->isTenantSelf($user, $resource)) ||
            ($this->isLandlordSelf($user,$resource)) // Changed so to view only self
        )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function canProfile(IdentityInterface $user, user $resource)
    {
        if
        (
            // Can only observe their own profiles
        $this->isSelf($user, $resource)
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
    public function canIndex(IdentityInterface $user, user $resource)
    {
        if (
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
    protected function isStaffSpecial(IdentityInterface $user, user $resource)
    {
        /*
        Staff cannot:
            Do changes with admin/staff accounts [CUD] - can only read
        However, can:
            edit own acc details [i.e. edit self & delete self]
        */
        if
        (
            ('staff' === $user->get('role')) &&
            ($this->siteAccess($user)) &&
            (
                ('admin' != $resource->role ) &&
                (
                    ('staff' != $resource->role) ||
                    (
                        ('staff' == $resource->role) && /* In case of some ID fiddlyness going on - still require correct role - although this may be optional */
                        ($resource->id === $user->getIdentifier())
                    )
                )
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
        if( ('tenant' === $user->get('role')) && ($this->siteAccess($user)) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    protected function isTenantSelf(IdentityInterface $user, user $resource)
    {
        /*
            Tenants should be able to edit, delete their own accounts [to a degree]
            Not edit things like:
                role
                id
        */
        if(
            ('tenant' === $user->get('role')) &&
            ($this->siteAccess($user)) &&
            ('tenant' === $resource->role) &&
            ($user->getIdentifier() === $resource->id)
        )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    /*
    Tenant can only see:
        themself
        landlord
    Currently not implemented as not allowing tenants to search landlord [front end will display on properties page where relevant]
    protected function isTenantSpecial(IdentityInterface $user, user $resource)
    {
        if(
            ($this->isTenant($user)) &&
            (
                (
                    // Tenant themselves
                    ('tenant' === $resource->role) &&
                    ($user->getIdentifier() === $resource->id)
                ) ||
                (
                    // Any landlord
                    ('tenant' === $resource->role)
                )
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
    */
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
    protected function isLandlordSelf(IdentityInterface $user, user $resource)
    {
        if(
            ($this->isLandlord($user)) &&
            ('landlord' === $resource->role) &&
            ($user->getIdentifier() === $resource->id)
        )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    protected function isLandlordSpecial(IdentityInterface $user, user $resource)
    {
        /*
            Landlord can only see:
                tenants
                themself
        */
        if(
            ($this->isLandlord($user)) &&
            (
                (
                    // Landlord themselves
                    ('landlord' === $resource->role) &&
                    ($user->getIdentifier() === $resource->id)
                ) ||
                (
                    // Any tenant
                ('tenant' === $resource->role)
                )
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

    protected function isSelf(IdentityInterface $user, user $resource)
    {
        if(
            // Access own resource
            ($user->get('role') === $resource->role) &&
            ($user->getIdentifier() === $resource->id) &&
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
