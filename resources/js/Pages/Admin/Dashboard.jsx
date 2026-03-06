import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout';

function StatCard({ label, value, icon, color, bg }) {
    return (
        <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: '1.5rem', display: 'flex', alignItems: 'center', gap: '1rem' }}>
            <div style={{ width: '3rem', height: '3rem', borderRadius: '0.5rem', background: bg, display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '1.25rem', flexShrink: 0 }}>
                {icon}
            </div>
            <div>
                <p style={{ fontSize: '1.75rem', fontFamily: "'Clash Display',sans-serif", fontWeight: 700, color: '#25324B', lineHeight: 1 }}>{value}</p>
                <p style={{ fontSize: '.875rem', color: '#7C8493', marginTop: '.25rem' }}>{label}</p>
            </div>
        </div>
    );
}

export default function AdminDashboard({ totalJobs, totalApplications, jobsThisMonth, appsThisMonth, recentJobs, recentApplications }) {
    return (
        <AdminLayout>
            <Head title="Admin Dashboard" />

            {/* Stats */}
            <div style={{ marginBottom: '2rem' }}>
                <h1 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: 'clamp(1.25rem,4vw,1.5rem)', fontWeight: 700, color: '#25324B', marginBottom: '1.25rem' }}>Dashboard</h1>
                <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill,minmax(200px,1fr))', gap: '1rem' }}>
                    <StatCard label="Total Jobs"            value={totalJobs}         icon="💼" color="#4640DE" bg="#EEF0FD" />
                    <StatCard label="Total Applications"    value={totalApplications} icon="📋" color="#56CDAD" bg="#E9FAF7" />
                    <StatCard label="Jobs This Month"       value={jobsThisMonth}     icon="📅" color="#FFB836" bg="#FFF8EE" />
                    <StatCard label="Apps This Month"       value={appsThisMonth}     icon="🚀" color="#26A4FF" bg="#E8F4FD" />
                </div>
            </div>

            {/* Two panels */}
            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit,minmax(300px,1fr))', gap: '1.5rem' }}>

                {/* Recent Jobs */}
                <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', overflow: 'hidden' }}>
                    <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', padding: '1rem 1.5rem', borderBottom: '1px solid #D6DDEB' }}>
                        <h2 style={{ fontFamily: "'Clash Display',sans-serif", fontWeight: 700, color: '#25324B', fontSize: '1rem' }}>Recent Jobs</h2>
                        <Link href="/admin/jobs" style={{ fontSize: '.8125rem', color: '#4640DE', textDecoration: 'none', fontWeight: 600 }}>View all →</Link>
                    </div>
                    <div>
                        {recentJobs?.length === 0 && (
                            <p style={{ padding: '1.5rem', textAlign: 'center', color: '#7C8493', fontSize: '.875rem' }}>No jobs yet.</p>
                        )}
                        {recentJobs?.map(job => (
                            <div key={job.id} style={{ display: 'flex', alignItems: 'center', gap: '.875rem', padding: '.875rem 1.5rem', borderBottom: '1px solid #F0F1F7' }}>
                                <div style={{ width: '2.25rem', height: '2.25rem', borderRadius: '0.375rem', background: '#EEF0FD', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700, color: '#4640DE', fontSize: '.75rem', flexShrink: 0 }}>
                                    {(job.company || '').slice(0, 2).toUpperCase()}
                                </div>
                                <div style={{ flex: 1, minWidth: 0 }}>
                                    <p style={{ fontWeight: 600, color: '#25324B', fontSize: '.875rem', whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' }}>{job.title}</p>
                                    <p style={{ fontSize: '.75rem', color: '#7C8493' }}>{job.company}</p>
                                </div>
                                <Link href={`/admin/jobs/${job.id}/edit`} style={{ fontSize: '.75rem', color: '#4640DE', textDecoration: 'none', fontWeight: 600, flexShrink: 0 }}>Edit</Link>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Recent Applications */}
                <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', overflow: 'hidden' }}>
                    <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', padding: '1rem 1.5rem', borderBottom: '1px solid #D6DDEB' }}>
                        <h2 style={{ fontFamily: "'Clash Display',sans-serif", fontWeight: 700, color: '#25324B', fontSize: '1rem' }}>Recent Applications</h2>
                        <Link href="/admin/applications" style={{ fontSize: '.8125rem', color: '#4640DE', textDecoration: 'none', fontWeight: 600 }}>View all →</Link>
                    </div>
                    <div>
                        {recentApplications?.length === 0 && (
                            <p style={{ padding: '1.5rem', textAlign: 'center', color: '#7C8493', fontSize: '.875rem' }}>No applications yet.</p>
                        )}
                        {recentApplications?.map(app => (
                            <div key={app.id} style={{ display: 'flex', alignItems: 'center', gap: '.875rem', padding: '.875rem 1.5rem', borderBottom: '1px solid #F0F1F7' }}>
                                <div style={{ width: '2.25rem', height: '2.25rem', borderRadius: '50%', background: '#E9FAF7', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700, color: '#56CDAD', fontSize: '.75rem', flexShrink: 0 }}>
                                    {(app.name || '').charAt(0).toUpperCase()}
                                </div>
                                <div style={{ flex: 1, minWidth: 0 }}>
                                    <p style={{ fontWeight: 600, color: '#25324B', fontSize: '.875rem', whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' }}>{app.name}</p>
                                    <p style={{ fontSize: '.75rem', color: '#7C8493' }}>{app.job?.title}</p>
                                </div>
                                <Link href={`/admin/applications/${app.id}`} style={{ fontSize: '.75rem', color: '#4640DE', textDecoration: 'none', fontWeight: 600, flexShrink: 0 }}>View</Link>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
