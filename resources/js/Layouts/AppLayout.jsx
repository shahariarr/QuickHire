import React, { useState } from 'react';
import { Link, usePage } from '@inertiajs/react';

function Navbar() {
    const [mobileOpen, setMobileOpen] = useState(false);
    const { url } = usePage();
    const isActive = href => url === href || url.startsWith(href + '?');

    const linkStyle = href => ({
        padding: '.5rem', fontSize: '1rem',
        fontWeight: isActive(href) ? 600 : 500,
        color: isActive(href) ? '#4640DE' : '#25324B',
        textDecoration: 'none', transition: 'color .2s',
    });

    return (
        <nav style={{
            position: 'sticky', top: 0, zIndex: 50,
            background: '#fff', borderBottom: '1px solid #D6DDEB',
        }}>
            <div className="container" style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', height: '72px' }}>
                {/* Logo */}
                <Link href="/" style={{ textDecoration: 'none', display: 'flex', alignItems: 'center', gap: '0.5rem' }}>
                    <span style={{ fontFamily: "'Clash Display',sans-serif", fontWeight: 700, fontSize: '1.5rem', color: '#25324B' }}>
                        Quick<span style={{ color: '#4640DE' }}>Hire</span>
                    </span>
                </Link>

                {/* Desktop nav */}
                <div style={{ display: 'flex', alignItems: 'center', gap: '1.5rem' }} className="hidden md:flex">
                    <Link href="/jobs" style={linkStyle('/jobs')}>Find Jobs</Link>
                    <a href="/#how-it-works" style={linkStyle('/#how-it-works')}>How It Works</a>
                    <Link href="/admin" style={{ ...linkStyle('/admin'), fontSize: '.875rem', color: '#7C8493' }}>Admin</Link>
                    <Link href="/jobs" className="primary-btn" style={{ fontSize: '.875rem', padding: '8px 20px' }}>Browse Jobs</Link>
                </div>

                {/* Mobile toggle */}
                <button className="md:hidden" onClick={() => setMobileOpen(o => !o)}
                    style={{ background: 'none', border: 'none', cursor: 'pointer', padding: '0.5rem' }}>
                    <svg width="22" height="22" fill="none" stroke="#25324B" strokeWidth="2" viewBox="0 0 24 24">
                        {mobileOpen
                            ? <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
                            : <path strokeLinecap="round" strokeLinejoin="round" d="M4 6h16M4 12h16M4 18h16" />}
                    </svg>
                </button>
            </div>

            {/* Mobile menu */}
            {mobileOpen && (
                <div style={{ background: '#fff', borderTop: '1px solid #D6DDEB', padding: '0.75rem 1rem' }} className="md:hidden">
                    <Link href="/jobs"   style={{ display: 'block', ...linkStyle('/jobs'),  padding: '0.625rem 0.75rem' }}>Find Jobs</Link>
                    <a href="/#how-it-works" style={{ display: 'block', ...linkStyle('/'), padding: '0.625rem 0.75rem' }}>How It Works</a>
                    <Link href="/admin"  style={{ display: 'block', ...linkStyle('/admin'), padding: '0.625rem 0.75rem', color: '#7C8493' }}>Admin</Link>
                </div>
            )}
        </nav>
    );
}

function Footer() {
    const col = { display: 'flex', flexDirection: 'column', gap: '0.875rem' };
    const link = { color: 'rgba(214,221,235,.7)', textDecoration: 'none', fontSize: '.875rem', transition: 'color .2s' };

    return (
        <footer style={{ background: '#202430' }}>
            <div className="container" style={{ paddingTop: '4rem', paddingBottom: '4rem' }}>
                <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit,minmax(160px,1fr))', gap: '2.5rem' }}>
                    <div>
                        <p style={{ fontFamily: "'Clash Display',sans-serif", fontWeight: 700, fontSize: '1.25rem', color: '#fff', marginBottom: '1rem' }}>
                            Quick<span style={{ color: '#4640DE' }}>Hire</span>
                        </p>
                        <p style={{ fontSize: '.875rem', color: 'rgba(214,221,235,.6)', lineHeight: 1.7 }}>
                            Great platform for job seekers searching for new career heights.
                        </p>
                    </div>
                    <div style={col}>
                        <p style={{ color: '#fff', fontWeight: 600, fontSize: '.875rem', marginBottom: '.25rem' }}>For Job Seekers</p>
                        {[['Browse Jobs', '/jobs'], ['How It Works', '/#how-it-works']].map(([t, h]) =>
                            <a key={t} href={h} style={link} onMouseEnter={e => e.target.style.color='#fff'} onMouseLeave={e => e.target.style.color='rgba(214,221,235,.7)'}>{t}</a>
                        )}
                    </div>
                    <div style={col}>
                        <p style={{ color: '#fff', fontWeight: 600, fontSize: '.875rem', marginBottom: '.25rem' }}>For Employers</p>
                        {[['Post a Job', '/admin/jobs/create']].map(([t, h]) =>
                            <a key={t} href={h} style={link} onMouseEnter={e => e.target.style.color='#fff'} onMouseLeave={e => e.target.style.color='rgba(214,221,235,.7)'}>{t}</a>
                        )}
                    </div>
                    <div style={col}>
                        <p style={{ color: '#fff', fontWeight: 600, fontSize: '.875rem', marginBottom: '.25rem' }}>Company</p>
                        {[['Admin Panel', '/admin']].map(([t, h]) =>
                            <a key={t} href={h} style={link} onMouseEnter={e => e.target.style.color='#fff'} onMouseLeave={e => e.target.style.color='rgba(214,221,235,.7)'}>{t}</a>
                        )}
                    </div>
                </div>
                <div style={{ borderTop: '1px solid rgba(214,221,235,.15)', marginTop: '3rem', paddingTop: '1.5rem', display: 'flex', justifyContent: 'center' }}>
                    <p style={{ fontSize: '.875rem', color: 'rgba(214,221,235,.5)' }}>© {new Date().getFullYear()} QuickHire. All rights reserved.</p>
                </div>
            </div>
        </footer>
    );
}

export default function AppLayout({ children, title }) {
    const { flash } = usePage().props;

    return (
        <>
            <Navbar />
            {flash?.success && (
                <div className="container" style={{ paddingTop: '0.75rem' }}>
                    <div style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', background: '#56cdad1a', border: '1px solid #56cdad29', color: '#56CDAD', borderRadius: '0.5rem', padding: '0.75rem 1rem', fontWeight: 500 }}>
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd"/></svg>
                        {flash.success}
                    </div>
                </div>
            )}
            {flash?.error && (
                <div className="container" style={{ paddingTop: '0.75rem' }}>
                    <div style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', background: '#ff832a1f', border: '1px solid #ffb93637', color: '#ff832ae5', borderRadius: '0.5rem', padding: '0.75rem 1rem', fontWeight: 500 }}>
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clipRule="evenodd"/></svg>
                        {flash.error}
                    </div>
                </div>
            )}
            <main>{children}</main>
            <Footer />
        </>
    );
}
