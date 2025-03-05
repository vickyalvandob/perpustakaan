import ApplicationLogo from '@/Components/ApplicationLogo';
import NavLinkResponsive from '@/Components/ui/NavLinkResponsive';
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
        <nav className="grid gap-6 text-lg font-medium">
            <ApplicationLogo />

            <nav className="grid items-start text-sm font-semibold lg:px-4">
                <div className="p-2 text-sm font-semibold text-foreground">Dashboard</div>
                <NavLinkResponsive
                    url={route('dashboard')}
                    active={url.startsWith('/dashboard')}
                    title="Dashboard"
                    icon={IconDashboard}
                />

                <div className="p-2 text-sm font-semibold text-foreground">Statistik</div>
                <NavLinkResponsive url="#" title="Statistik Peminjaman" icon={IconBrandHipchat} />
                <NavLinkResponsive url="#" title="Laporan Denda" icon={IconMoneybag} />
                <NavLinkResponsive url="#" title="Laporan Stok Buku" icon={IconStack3} />

                <div className="p-2 text-sm font-semibold text-foreground">Master</div>
                <NavLinkResponsive
                    url={route('admin.category.index')}
                    active={url.startsWith('/admin/categories')}
                    title="Kategori"
                    icon={IconCategory}
                />
                  <NavLinkResponsive
                        url={route('admin.publisher.index')}
                        active={url.startsWith('/admin/publishers')}
                        title="Penerbit"
                        icon={IconBuildingCommunity}
                    />
                     <NavLinkResponsive
                        url={route('admin.book.index')}
                        active={url.startsWith('/admin/books')}
                        title="Buku"
                        icon={IconBooks}
                    />
               
                <NavLinkResponsive url="#" title="Buku" icon={IconBooks} />
                <NavLinkResponsive url="#" title="Pengguna" icon={IconUsersGroup} />
                <NavLinkResponsive url="#" title="Pengaturan Denda" icon={IconSettingsExclamation} />

                <div className="p-2 text-sm font-semibold text-foreground">Peran dan Izin</div>
                <NavLinkResponsive url="#" title="Peran" icon={IconVersions} />
                <NavLinkResponsive url="#" title="Tetapkan Izin" icon={IconKeyframe} />
                <NavLinkResponsive url="#" title="Tetapkan Peran" icon={IconLayoutKanban} />
                <NavLinkResponsive url="#" title="Akses Rute" icon={IconRoute} />

                <div className="p-2 text-sm font-semibold text-foreground">Transaksi</div>
                <NavLinkResponsive url="#" title="Peminjaman" icon={IconCreditCardPay} />
                <NavLinkResponsive url="#" title="Pengembalian" icon={IconCreditCardRefund} />

                <div className="p-2 text-sm font-semibold text-foreground">Lainnya</div>
                <NavLinkResponsive url="#" title="Pengumuman" icon={IconAlertCircle} />
                <NavLinkResponsive url={route('profile.edit')} title="Profile" icon={IconUser} />
                <NavLinkResponsive
                    url={route('logout')}
                    title="Logout"
                    icon={IconLogout}
                    method="post"
                    as="button"
                    className="w-full"
                />
            </nav>
        </nav>
    );
}
