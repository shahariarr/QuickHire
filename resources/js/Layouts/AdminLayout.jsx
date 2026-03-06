import React, { useState } from 'react';
import { Link, usePage, router } from '@inertiajs/react';

export default function AdminLayout({ children }) {
    const { url, props } = usePage();
    const { flash } = props;
    const [sidebarOpen, setSidebarOpen] = useState(false);

    const navItems = [
        { label: 'Dashboard',    href: '/admin',               icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' },
        { label: 'Jobs',         href: '/admin/jobs',           icon: 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z' },
        { label: 'Applications', href: '/admin/applications',   icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' },
    ];

    const isActive = href => href === '/admin' ? url === '/admin' : url.startsWith(href);

    const sidebarLink = (item) => ({
        display: 'flex', alignItems: 'center', gap: '0.75rem',
        padding: '0.625rem 1rem', borderRadius: '0.375rem', textDecoration: 'none',
        fontSize: '.875rem', fontWeight: 500, transition: 'all .2s',
        background: isActive(item.href) ? '#EEF0FD' : 'transparent',
        color: isActive(item.href) ? '#4640DE' : '#515B6F',
    });

    const SidebarContent = () => (
        <div style={{ padding: '1.25rem 0.75rem', display: 'flex', flexDirection: 'column', height: '100%' }}>
            {/* Logo */}
            <Link href="/" style={{ textDecoration: 'none', display: 'block', padding: '0.5rem 0.75rem', marginBottom: '1.5rem' }}>
                <span style={{ fontFamily: "'Clash Display',sans-serif", fontWeight: 700, fontSize: '1.375rem', color: '#25324B' }}>
                    Quick<span style={{ color: '#4640DE' }}>Hire</span>
                </span>
                <span style={{ display: 'block', fontSize: '.7rem', color: '#7C8493', marginTop: '.125rem' }}>Admin Panel</span>
            </Link>

            {/* Nav links */}
            <nav style={{ display: 'flex', flexDirection: 'column', gap: '0.25rem', flex: 1 }}>
                {navItems.map(item => (
                    <Link key={item.href} href={item.href} style={sidebarLink(item)}>
                        <svg width="18" height="18" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" d={item.icon} />
                        </svg>
                        {item.label}
                    </Link>
                ))}
            </nav>

            {/* Bottom: back to site */}
            <div style={{ borderTop: '1px solid #D6DDEB', paddingTop: '1rem', marginTop: '1rem' }}>
                <Link href="/" style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', fontSize: '.8rem', color: '#7C8493', textDecoration: 'none' }}>
                    <svg width="16" height="16" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to website
                </Link>
            </div>
        </div>
    );

    return (
        <div style={{ display: 'flex', minHeight: '100vh', background: '#F8F8FD' }}>
            {/* Desktop sidebar */}
            <aside style={{ width: '240px', background: '#fff', borderRight: '1px solid #D6DDEB', flexShrink: 0, position: 'sticky', top: 0, height: '100vh', overflowY: 'auto' }}
                className="hidden lg:block">
                <SidebarContent />
            </aside>

            {/* Mobile sidebar overlay */}
            {sidebarOpen && (
                <div style={{ position: 'fixed', inset: 0, zIndex: 40 }}>
                    <div style={{ position: 'absolute', inset: 0, background: 'rgba(0,0,0,.4)' }} onClick={() => setSidebarOpen(false)} />
                    <aside style={{ position: 'absolute', left: 0, top: 0, bottom: 0, width: '240px', background: '#fff', zIndex: 50 }}>
                        <SidebarContent />
                    </aside>
                </div>
            )}

            {/* Main */}
            <div style={{ flex: 1, display: 'flex', flexDirection: 'column', minWidth: 0 }}>
                {/* Top bar */}
                <header className="admin-topbar" style={{ background: '#fff', borderBottom: '1px solid #D6DDEB', padding: '0 1.5rem', display: 'flex', alignItems: 'center', justifyContent: 'space-between', height: '64px', position: 'sticky', top: 0, zIndex: 30 }}>
                    <div style={{ display: 'flex', alignItems: 'center', gap: '1rem' }}>
                        <button className="lg:hidden" onClick={() => setSidebarOpen(true)}
                            style={{ background: 'none', border: 'none', cursor: 'pointer', padding: '0.25rem' }}>
                            <svg width="22" height="22" fill="none" stroke="#25324B" strokeWidth="2" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                    <Link href="/admin/jobs/create" className="primary-btn" style={{ fontSize: '.875rem', padding: '8px 18px' }}>
                        + Post Job
                    </Link>
                </header>

                {/* Flash messages */}
                {flash?.success && (
                    <div className="admin-flash" style={{ margin: '1rem 1.5rem 0' }}>
                        <div style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', background: '#56cdad1a', border: '1px solid #56cdad29', color: '#56CDAD', borderRadius: '0.5rem', padding: '0.75rem 1rem', fontWeight: 500, fontSize: '.875rem' }}>
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd"/></svg>
                            {flash.success}
                        </div>
                    </div>
                )}
                {flash?.error && (
                    <div className="admin-flash" style={{ margin: '1rem 1.5rem 0' }}>
                        <div style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', background: '#ff832a1f', border: '1px solid #ffb93637', color: '#ff832ae5', borderRadius: '0.5rem', padding: '0.75rem 1rem', fontWeight: 500, fontSize: '.875rem' }}>
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clipRule="evenodd"/></svg>
                            {flash.error}
                        </div>
                    </div>
                )}

                {/* Page content */}
                <div className="admin-body" style={{ flex: 1, padding: '1.5rem' }}>
                    {children}
                </div>
            </div>
        </div>
    );
}
