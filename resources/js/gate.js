export default class Gate {
    constructor(user) {
        this.user = user;
    }

    isSuperAdmin() {
        return this.user.type === 'super admin';
    }

    isAdmin() {
        return this.user.type === 'admin';
    }

    isUser() {
        return true;
    }

    isSuperAdminOrAdmin() {
        if (this.user.type === "super admin" || this.user.type === "admin") {
            return true;
        } else {
            return false;
        }
    }
}
