import React, { useState, useCallback } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout';

function debounce(fn, delay) {
    let t;
    return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), delay); };
}

function Pagination({ links }) {
    return (
        <div style={{ display: 'flex', justifyContent: 'center', gap: '.5rem', marginTop: '1.5rem', flexWrap: 'wrap' }}>
            {links.map((link, i) => {
                if (!link.url) {
                    return <span key={i} dangerouslySetInnerHTML={{ __html: link.label }}
                        style={{ padding: '5px 12px', borderRadius: '4px', fontSize: '.8125rem', color: '#7C8493' }} />;
                }
                return <Link key={i} href={link.url} preserveState
                    dangerouslySetInnerHTML={{ __html: link.label }}
                    style={{ padding: '5px 12px', borderRadius: '4px', fontSize: '.8125rem', textDecoration: 'none', border: '1px solid', borderColor: link.active ? '#4640DE' : '#D6DDEB', background: link.active ? '#4640DE' : '#fff', color: link.active ? '#fff' : '#515B6F' }} />;
            })}
        </div>
    );
}

const STATUS_COLOR = {
    pending:  { border: '#FFB836', color: '#FFB836', bg: '#FFF8EE' },
    reviewed: { border: '#26A4FF', color: '#26A4FF', bg: '#E8F4FD' },
    accepted: { border: '#56CDAD', color: '#56CDAD', bg: '#E9FAF7' },
    rejected: { border: '#d32f2f', color: '#d32f2f', bg: '#FFF2F2' },
};

export default function AdminApplicationsIndex({ applications, filters }) {
    const [search, setSearch] = useState(filters?.search ?? '');

    const visitSearch = useCallback(debounce((q) => {
        router.visit('/admin/applications', { data: { search: q }, preserveState: true, replace: true });
    }, 350), []);

    return (
        <AdminLayout>
            <Head title="Applications" />

            <div style={{ marginBottom: '1.5rem', display: 'flex', alignItems: 'center', justifyContent: 'space-between', flexWrap: 'wrap', gap: '1rem' }}>
                    <h1 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: 'clamp(1.25rem,4vw,1.5rem)', fontWeight: 700, color: '#25324B' }}>
                    Applications
                    {applications?.total > 0 && (
                        <span style={{ fontFamily: 'inherit', fontSize: '1rem', color: '#4640DE', marginLeft: '.5rem' }}>({applications.total})</span>
                    )}
                </h1>
            </div>

            {/* Search */}
            <div style={{ marginBottom: '1.25rem' }}>
                <input value={search}
                    onChange={e => { setSearch(e.target.value); visitSearch(e.target.value); }}
                    placeholder="Search by name, email, or job..."
                    style={{ padding: '8px 14px', border: '1px solid #D6DDEB', borderRadius: '4px', fontSize: '.875rem', color: '#25324B', outline: 'none', width: '100%', maxWidth: '380px', boxSizing: 'border-box' }} />
            </div>

            {/* Table */}
            <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', overflow: 'hidden' }}>
                {applications?.data?.length === 0 ? (
                    <p style={{ padding: '2.5rem', textAlign: 'center', color: '#7C8493' }}>No applications found.</p>
                ) : (
                    <div style={{ overflowX: 'auto' }}>
                        <table style={{ width: '100%', borderCollapse: 'collapse' }}>
                            <thead>
                                <tr style={{ background: '#F8F8FD', fontSize: '.8125rem', color: '#7C8493', fontWeight: 600, textTransform: 'uppercase', letterSpacing: '.04em' }}>
                                    <th style={{ padding: '.75rem 1.25rem', textAlign: 'left', borderBottom: '1px solid #D6DDEB' }}>Applicant</th>
                                    <th style={{ padding: '.75rem 1.25rem', textAlign: 'left', borderBottom: '1px solid #D6DDEB' }}>Job</th>
                                    <th style={{ padding: '.75rem 1.25rem', textAlign: 'left', borderBottom: '1px solid #D6DDEB' }}>Status</th>
                                    <th style={{ padding: '.75rem 1.25rem', textAlign: 'left', borderBottom: '1px solid #D6DDEB' }}>Applied</th>
                                    <th style={{ padding: '.75rem 1.25rem', textAlign: 'right', borderBottom: '1px solid #D6DDEB' }}>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {applications?.data?.map((app, idx) => {
                                    const sc = STATUS_COLOR[app.status] ?? STATUS_COLOR.pending;
                                    return (
                                        <tr key={app.id} style={{ background: idx % 2 === 0 ? '#fff' : '#FAFAFA' }}>
                                            <td style={{ padding: '.875rem 1.25rem', borderBottom: '1px solid #F0F1F7' }}>
                                                <div style={{ display: 'flex', alignItems: 'center', gap: '.625rem' }}>
                                                    <div style={{ width: '2rem', height: '2rem', borderRadius: '50%', background: '#E9FAF7', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700, color: '#56CDAD', fontSize: '.75rem', flexShrink: 0 }}>
                                                        {(app.name || '').charAt(0).toUpperCase()}
                                                    </div>
                                                    <div>
                                                        <p style={{ fontWeight: 600, color: '#25324B', fontSize: '.875rem' }}>{app.name}</p>
                                                        <p style={{ fontSize: '.75rem', color: '#7C8493' }}>{app.email}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style={{ padding: '.875rem 1.25rem', borderBottom: '1px solid #F0F1F7', color: '#515B6F', fontSize: '.875rem' }}>
                                                {app.job ? (
                                                    <Link href={`/jobs/${app.job.id}`} style={{ color: '#4640DE', textDecoration: 'none', fontWeight: 500 }}>{app.job.title}</Link>
                                                ) : '–'}
                                            </td>
                                            <td style={{ padding: '.875rem 1.25rem', borderBottom: '1px solid #F0F1F7' }}>
                                                <span style={{ fontSize: '.75rem', fontWeight: 600, padding: '3px 10px', borderRadius: '3px', border: `1px solid ${sc.border}`, color: sc.color, background: sc.bg, textTransform: 'capitalize' }}>
                                                    {app.status ?? 'pending'}
                                                </span>
                                            </td>
                                            <td style={{ padding: '.875rem 1.25rem', borderBottom: '1px solid #F0F1F7', color: '#7C8493', fontSize: '.8125rem' }}>
                                                {new Date(app.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}
                                            </td>
                                            <td style={{ padding: '.875rem 1.25rem', borderBottom: '1px solid #F0F1F7', textAlign: 'right' }}>
                                                <Link href={`/admin/applications/${app.id}`}
                                                    style={{ fontSize: '.8125rem', color: '#4640DE', textDecoration: 'none', fontWeight: 600 }}>View</Link>
                                            </td>
                                        </tr>
                                    );
                                })}
                            </tbody>
                        </table>
                    </div>
                )}
            </div>

            {applications?.links && <Pagination links={applications.links} />}
        </AdminLayout>
    );
}
