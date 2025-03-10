import NavLink from '@/Components/NavLink';
import {
    IconAlertCircle,
    IconBooks,
    IconBrandHipchat,
    IconBuildingCommunity,
    IconCategory,
    IconCreditCardPay,
    IconCreditCardRefund,
    IconDashboard,
    IconKeyframe,
    IconLayoutKanban,
    IconLogout,
    IconMoneybag,
    IconRoute,
    IconSettingsExclamation,
    IconStack3,
    IconUser,
    IconUsersGroup,
    IconVersions,
} from '@tabler/icons-react';

export default function Sidebar({ url, auth }) {
    return (
        <nav className="grid items-start px-2 text-sm font-semibold lg:px-4">
            <div className="px-3 py-2 text-sm font-semibold text-foreground">Dashboard</div>
            <NavLink
                url={route('dashboard')}
                active={url.startsWith('/dashboard')}
                title="Dashboard"
                icon={IconDashboard}
            />

            <div className="px-3 py-2 text-sm font-semibold text-foreground">Statistik</div>
            <NavLink url="#" title="Statistik Peminjaman" icon={IconBrandHipchat} />
            <NavLink url="#" title="Laporan Denda" icon={IconMoneybag} />
            <NavLink url="#" title="Laporan Stok Buku" icon={IconStack3} />

            <div className="px-3 py-2 text-sm font-semibold text-foreground">Master</div>
            <NavLink
                url={route('admin.category.index')}
                active={url.startsWith('/admin/categories')}
                title="Kategori"
                icon={IconCategory}
            />
             <NavLink
                url={route('admin.publisher.index')}
                active={url.startsWith('/admin/publishers')}
                title="Penerbit"
                icon={IconBuildingCommunity}
            />

            <NavLink
                url={route('admin.book.index')}
                active={url.startsWith('/admin/books')}
                title="Buku"
                icon={IconBooks}
            />
          
            <NavLink url="#" title="Buku" icon={IconBooks} />
            <NavLink url="#" title="Pengguna" icon={IconUsersGroup} />
            <NavLink url="#" title="Pengaturan Denda" icon={IconSettingsExclamation} />

            <div className="px-3 py-2 text-sm font-semibold text-foreground">Peran dan Izin</div>
            <NavLink url="#" title="Peran" icon={IconVersions} />
            <NavLink url="#" title="Tetapkan Izin" icon={IconKeyframe} />
            <NavLink url="#" title="Tetapkan Peran" icon={IconLayoutKanban} />
            <NavLink url="#" title="Akses Rute" icon={IconRoute} />

            <div className="px-3 py-2 text-sm font-semibold text-foreground">Transaksi</div>
            <NavLink url="#" title="Peminjaman" icon={IconCreditCardPay} />
            <NavLink url="#" title="Pengembalian" icon={IconCreditCardRefund} />

            <div className="px-3 py-2 text-sm font-semibold text-foreground">Lainnya</div>
            <NavLink url="#" title="Pengumuman" icon={IconAlertCircle} />
            <NavLink url={route('profile.edit')} title="Profile" icon={IconUser} />
            <NavLink
                url={route('logout')}
                title="Logout"
                icon={IconLogout}
                method="post"
                as="button"
                className="w-full"
            />
        </nav>
    );
}
