<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\tenant;
use Authorization\IdentityInterface;

/**
 * tenant policy
 */
class tenantPolicy
{
    /**
     * Check if $user can add tenant
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\tenant $tenant
     * @return bool
     */
    public function canAdd(IdentityInterface $user, tenant $tenant)
    {
        if (
            (isEmployee($user)) ||
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
     * Check if $user can edit tenant
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\tenant $tenant
     * @return bool
     */
    public function canEdit(IdentityInterface $user, tenant $tenant)
    {
        if (
            (isEmployee($user)) ||
            ($this->isTenantSelf($user, $tenant))
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
     * Check if $user can delete tenant
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\tenant $tenant
     * @return bool
     */
    public function canDelete(IdentityInterface $user, tenant $tenant)
    {
        if (
            (isEmployee($user)) ||
            ($this->isTenantSelf($user, $tenant))
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
     * Check if $user can view tenant
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\tenant $tenant
     * @return bool
     */
    public function canView(IdentityInterface $user, tenant $tenant)
    {
        if (
            ($this->isEmployee($user)) ||
            ($this->isTenantSelf($user, $tenant))
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
    public function canIndex(IdentityInterface $user, tenant $tenant)
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
    protected function isTenantSelf(IdentityInterface $user, tenant $tenant)
    {
        /*
        Should only be able to edit/add/delete own details
        */
        if(
            ('tenant' === $user->get('role')) &&
            ($this->siteAccess($user)) &&
            ($user->getIdentifier() === $tenant->user_id)
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
        return false; // Currently disabling access to this section from all users
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
