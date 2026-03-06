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
                    return (
                        <span key={i} dangerouslySetInnerHTML={{ __html: link.label }}
                            style={{ padding: '5px 12px', borderRadius: '4px', fontSize: '.8125rem', color: '#7C8493' }} />
                    );
                }
                return (
                    <Link key={i} href={link.url} preserveState
                        dangerouslySetInnerHTML={{ __html: link.label }}
                        style={{ padding: '5px 12px', borderRadius: '4px', fontSize: '.8125rem', textDecoration: 'none', border: '1px solid', borderColor: link.active ? '#4640DE' : '#D6DDEB', background: link.active ? '#4640DE' : '#fff', color: link.active ? '#fff' : '#515B6F' }} />
                );
            })}
        </div>
    );
}

export default function AdminJobsIndex({ jobs, filters }) {
    const [search, setSearch] = useState(filters?.search ?? '');

    const visitSearch = useCallback(debounce((q) => {
        router.visit('/admin/jobs', { data: { search: q }, preserveState: true, replace: true });
    }, 350), []);

    const handleDeleteJob = (id, title) => {
        if (confirm(`Delete "${title}"? This cannot be undone.`)) {
            router.delete(`/admin/jobs/${id}`);
        }
    };

    return (
        <AdminLayout>
            <Head title="Manage Jobs" />

            <div style={{ marginBottom: '1.5rem', display: 'flex', alignItems: 'center', justifyContent: 'space-between', flexWrap: 'wrap', gap: '1rem' }}>
                <h1 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: 'clamp(1.25rem,4vw,1.5rem)', fontWeight: 700, color: '#25324B' }}>Jobs</h1>
                <Link href="/admin/jobs/create"
                    style={{ background: '#4640DE', color: '#fff', fontWeight: 700, padding: '10px 20px', borderRadius: '0.375rem', textDecoration: 'none', fontSize: '.9375rem' }}>
                    + Post Job
                </Link>
            </div>

            {/* Search */}
            <div style={{ marginBottom: '1.25rem' }}>
                <input value={search}
                    onChange={e => { setSearch(e.target.value); visitSearch(e.target.value); }}
                    placeholder="Search jobs..."
                    style={{ padding: '8px 14px', border: '1px solid #D6DDEB', borderRadius: '4px', fontSize: '.875rem', color: '#25324B', outline: 'none', width: '100%', maxWidth: '320px', boxSizing: 'border-box' }} />
            </div>

            {/* Table */}
            <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', overflow: 'hidden' }}>
                {jobs?.data?.length === 0 ? (
                    <p style={{ padding: '2.5rem', textAlign: 'center', color: '#7C8493' }}>No jobs found.</p>
                ) : (
                    <div style={{ overflowX: 'auto' }}>
                        <table style={{ width: '100%', borderCollapse: 'collapse' }}>
                            <thead>
                                <tr style={{ background: '#F8F8FD', fontSize: '.8125rem', color: '#7C8493', fontWeight: 600, textTransform: 'uppercase', letterSpacing: '.04em' }}>
                                    <th style={{ padding: '.75rem 1.25rem', textAlign: 'left', borderBottom: '1px solid #D6DDEB' }}>Job</th>
                                    <th style={{ padding: '.75rem 1.25rem', textAlign: 'left', borderBottom: '1px solid #D6DDEB' }}>Company</th>
                                    <th style={{ padding: '.75rem 1.25rem', textAlign: 'left', borderBottom: '1px solid #D6DDEB' }}>Category</th>
                                    <th style={{ padding: '.75rem 1.25rem', textAlign: 'left', borderBottom: '1px solid #D6DDEB' }}>Location</th>
                                    <th style={{ padding: '.75rem 1.25rem', textAlign: 'right', borderBottom: '1px solid #D6DDEB' }}>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {jobs?.data?.map((job, idx) => (
                                    <tr key={job.id} style={{ background: idx % 2 === 0 ? '#fff' : '#FAFAFA' }}>
                                        <td style={{ padding: '.875rem 1.25rem', borderBottom: '1px solid #F0F1F7' }}>
                                            <p style={{ fontWeight: 600, color: '#25324B', fontSize: '.9375rem' }}>{job.title}</p>
                                            <p style={{ fontSize: '.75rem', color: '#7C8493', marginTop: '.125rem' }}>
                                                {new Date(job.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}
                                            </p>
                                        </td>
                                        <td style={{ padding: '.875rem 1.25rem', borderBottom: '1px solid #F0F1F7', color: '#515B6F', fontSize: '.9375rem' }}>{job.company}</td>
                                        <td style={{ padding: '.875rem 1.25rem', borderBottom: '1px solid #F0F1F7' }}>
                                            {job.category && <span style={{ fontSize: '.75rem', fontWeight: 600, padding: '3px 10px', borderRadius: '3px', border: '1px solid #FFB836', color: '#FFB836', background: '#FFF8EE' }}>{job.category}</span>}
                                        </td>
                                        <td style={{ padding: '.875rem 1.25rem', borderBottom: '1px solid #F0F1F7', color: '#515B6F', fontSize: '.875rem' }}>{job.location}</td>
                                        <td style={{ padding: '.875rem 1.25rem', borderBottom: '1px solid #F0F1F7', textAlign: 'right', whiteSpace: 'nowrap' }}>
                                            <Link href={`/jobs/${job.id}`} target="_blank"
                                                style={{ fontSize: '.8125rem', color: '#26A4FF', textDecoration: 'none', fontWeight: 600, marginRight: '.75rem' }}>View</Link>
                                            <Link href={`/admin/jobs/${job.id}/edit`}
                                                style={{ fontSize: '.8125rem', color: '#4640DE', textDecoration: 'none', fontWeight: 600, marginRight: '.75rem' }}>Edit</Link>
                                            <button onClick={() => handleDeleteJob(job.id, job.title)}
                                                style={{ fontSize: '.8125rem', color: '#d32f2f', background: 'none', border: 'none', cursor: 'pointer', fontWeight: 600, fontFamily: 'inherit', padding: 0 }}>Delete</button>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                )}
            </div>

            {jobs?.links && <Pagination links={jobs.links} />}
        </AdminLayout>
    );
}
