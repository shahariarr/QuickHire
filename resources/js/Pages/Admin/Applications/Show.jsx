import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout';

const STATUS_COLOR = {
    pending:  { border: '#FFB836', color: '#FFB836', bg: '#FFF8EE' },
    reviewed: { border: '#26A4FF', color: '#26A4FF', bg: '#E8F4FD' },
    accepted: { border: '#56CDAD', color: '#56CDAD', bg: '#E9FAF7' },
    rejected: { border: '#d32f2f', color: '#d32f2f', bg: '#FFF2F2' },
};

function DetailRow({ label, value }) {
    if (!value) return null;
    return (
        <div style={{ display: 'flex', gap: '1rem', padding: '.875rem 0', borderBottom: '1px solid #F0F1F7', flexWrap: 'wrap' }}>
            <dt style={{ width: '140px', flexShrink: 0, fontSize: '.8125rem', fontWeight: 600, color: '#7C8493', textTransform: 'uppercase', letterSpacing: '.04em', paddingTop: '.125rem' }}>{label}</dt>
            <dd style={{ flex: 1, color: '#25324B', fontSize: '.9375rem' }}>{value}</dd>
        </div>
    );
}

export default function AdminApplicationShow({ application }) {
    const sc = STATUS_COLOR[application.status] ?? STATUS_COLOR.pending;
    const postedDate = application.created_at
        ? new Date(application.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
        : '';

    return (
        <AdminLayout>
            <Head title={`Application – ${application.name}`} />

            <div style={{ marginBottom: '1.5rem', display: 'flex', alignItems: 'center', gap: '1rem' }}>
                <Link href="/admin/applications" style={{ color: '#7C8493', textDecoration: 'none', fontSize: '.875rem' }}>← Back to Applications</Link>
            </div>

            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit,minmax(280px,1fr))', gap: '1.5rem', alignItems: 'start' }}>

                {/* Applicant card */}
                <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', overflow: 'hidden' }}>
                    <div style={{ background: '#F8F8FD', borderBottom: '1px solid #D6DDEB', padding: '1.5rem' }}>
                        <div style={{ display: 'flex', alignItems: 'center', gap: '1rem' }}>
                            <div style={{ width: '3.5rem', height: '3.5rem', borderRadius: '50%', background: '#EEF0FD', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700, color: '#4640DE', fontSize: '1.25rem', flexShrink: 0 }}>
                                {(application.name || '').charAt(0).toUpperCase()}
                            </div>
                            <div>
                                <p style={{ fontFamily: "'Clash Display',sans-serif", fontWeight: 700, color: '#25324B', fontSize: '1.125rem' }}>{application.name}</p>
                                <p style={{ fontSize: '.875rem', color: '#7C8493' }}>{application.email}</p>
                            </div>
                        </div>
                        <div style={{ marginTop: '1rem' }}>
                            <span style={{ fontSize: '.8125rem', fontWeight: 600, padding: '4px 12px', borderRadius: '3px', border: `1px solid ${sc.border}`, color: sc.color, background: sc.bg, textTransform: 'capitalize' }}>
                                {application.status ?? 'pending'}
                            </span>
                        </div>
                    </div>

                    <dl style={{ padding: '0 1.5rem' }}>
                        <DetailRow label="Applied" value={postedDate} />
                        <DetailRow label="Resume" value={
                            application.resume_link ? (
                                <a href={application.resume_link} target="_blank" rel="noopener noreferrer"
                                    style={{ color: '#4640DE', wordBreak: 'break-all' }}>
                                    {application.resume_link}
                                </a>
                            ) : null
                        } />
                    </dl>
                </div>

                {/* Job + Cover note card */}
                <div style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
                    {/* Job info */}
                    <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: '1.5rem' }}>
                        <h3 style={{ fontFamily: "'Clash Display',sans-serif", fontWeight: 700, color: '#25324B', marginBottom: '1rem', fontSize: '1rem', paddingBottom: '.75rem', borderBottom: '1px solid #D6DDEB' }}>
                            Applied For
                        </h3>
                        {application.job ? (
                            <div style={{ display: 'flex', alignItems: 'center', gap: '.875rem' }}>
                                <div style={{ width: '3rem', height: '3rem', borderRadius: '0.5rem', background: '#EEF0FD', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700, color: '#4640DE', flexShrink: 0 }}>
                                    {(application.job.company || '').slice(0, 2).toUpperCase()}
                                </div>
                                <div>
                                    <Link href={`/jobs/${application.job.id}`}
                                        style={{ fontWeight: 700, color: '#25324B', fontSize: '1rem', textDecoration: 'none' }}>
                                        {application.job.title}
                                    </Link>
                                    <p style={{ fontSize: '.875rem', color: '#7C8493', marginTop: '.125rem' }}>
                                        {application.job.company} · {application.job.location}
                                    </p>
                                </div>
                            </div>
                        ) : (
                            <p style={{ color: '#7C8493', fontSize: '.875rem' }}>Job not found.</p>
                        )}
                    </div>

                    {/* Cover note */}
                    {application.cover_note && (
                        <div style={{ background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: '1.5rem' }}>
                            <h3 style={{ fontFamily: "'Clash Display',sans-serif", fontWeight: 700, color: '#25324B', marginBottom: '.875rem', fontSize: '1rem', paddingBottom: '.75rem', borderBottom: '1px solid #D6DDEB' }}>
                                Cover Note
                            </h3>
                            <p style={{ color: '#515B6F', lineHeight: 1.75, fontSize: '.9375rem', whiteSpace: 'pre-wrap' }}>
                                {application.cover_note}
                            </p>
                        </div>
                    )}
                </div>
            </div>
        </AdminLayout>
    );
}
