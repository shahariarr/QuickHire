import React from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';

function Field({ label, error, children }) {
    return (
        <div style={{ marginBottom: '1.5rem' }}>
            <label style={{ display: 'block', fontSize: '.8125rem', fontWeight: 600, color: '#25324B', marginBottom: '.375rem' }}>{label}</label>
            {children}
            {error && <p style={{ fontSize: '.8125rem', color: '#d32f2f', marginTop: '.25rem' }}>{error}</p>}
        </div>
    );
}

const inputStyle = (hasError) => ({
    width: '100%',
    padding: '10px 14px',
    border: `1px solid ${hasError ? '#d32f2f' : '#D6DDEB'}`,
    borderRadius: '4px',
    fontSize: '.9375rem',
    color: '#25324B',
    outline: 'none',
    background: '#fff',
    boxSizing: 'border-box',
    fontFamily: 'inherit',
});

export default function JobApply({ job }) {
    const { data, setData, post, processing, errors } = useForm({
        name:        '',
        email:       '',
        resume_link: '',
        cover_note:  '',
    });

    const submit = e => {
        e.preventDefault();
        post(`/jobs/${job.id}/apply`);
    };

    return (
        <AppLayout>
            <Head title={`Apply – ${job.title}`} />

            {/* ── Header ─── */}
            <div style={{ background: '#F8F8FD', borderBottom: '1px solid #D6DDEB', padding: '2rem 0' }}>
                <div className="container">
                    <nav style={{ fontSize: '.8125rem', color: '#7C8493', marginBottom: '.5rem' }}>
                        <Link href="/jobs" style={{ color: '#7C8493', textDecoration: 'none' }}>Jobs</Link>
                        {' / '}
                        <Link href={`/jobs/${job.id}`} style={{ color: '#7C8493', textDecoration: 'none' }}>{job.title}</Link>
                        {' / '}
                        <span style={{ color: '#25324B' }}>Apply</span>
                    </nav>
                    <h1 style={{ fontFamily: "'Clash Display',sans-serif", fontSize: 'clamp(1.25rem,4vw,1.75rem)', fontWeight: 700, color: '#25324B' }}>
                        Apply for {job.title}
                    </h1>
                    <p style={{ color: '#515B6F', marginTop: '.25rem' }}>{job.company} · {job.location}</p>
                </div>
            </div>

            {/* ── Form ─── */}
            <div className="container" style={{ paddingTop: '2.5rem', paddingBottom: '4rem', display: 'flex', justifyContent: 'center' }}>
                <div style={{ width: '100%', maxWidth: '560px', background: '#fff', border: '1px solid #D6DDEB', borderRadius: '0.5rem', padding: 'clamp(1.25rem,4vw,2rem)' }}>
                    <form onSubmit={submit}>
                        <Field label="Full Name" error={errors.name}>
                            <input value={data.name} onChange={e => setData('name', e.target.value)}
                                placeholder="Jane Doe" style={inputStyle(!!errors.name)} />
                        </Field>

                        <Field label="Email Address" error={errors.email}>
                            <input type="email" value={data.email} onChange={e => setData('email', e.target.value)}
                                placeholder="jane@example.com" style={inputStyle(!!errors.email)} />
                        </Field>

                        <Field label="Resume / Portfolio Link" error={errors.resume_link}>
                            <input type="url" value={data.resume_link} onChange={e => setData('resume_link', e.target.value)}
                                placeholder="https://linkedin.com/in/..." style={inputStyle(!!errors.resume_link)} />
                            <p style={{ fontSize: '.75rem', color: '#7C8493', marginTop: '.25rem' }}>Link to your resume, LinkedIn, GitHub, or portfolio.</p>
                        </Field>

                        <Field label="Cover Note" error={errors.cover_note}>
                            <textarea value={data.cover_note} onChange={e => setData('cover_note', e.target.value)}
                                rows={5} placeholder="Tell us why you're a great fit for this role..."
                                style={{ ...inputStyle(!!errors.cover_note), resize: 'vertical' }} />
                        </Field>

                        <div style={{ display: 'flex', gap: '1rem', marginTop: '2rem' }}>
                            <button type="submit" disabled={processing}
                                style={{ flex: 1, background: '#4640DE', color: '#fff', fontWeight: 700, padding: '12px 24px', borderRadius: '0.375rem', border: 'none', cursor: processing ? 'not-allowed' : 'pointer', opacity: processing ? .7 : 1, fontSize: '.9375rem' }}>
                                {processing ? 'Submitting…' : 'Submit Application'}
                            </button>
                            <Link href={`/jobs/${job.id}`}
                                style={{ padding: '12px 24px', borderRadius: '0.375rem', border: '1px solid #D6DDEB', color: '#515B6F', textDecoration: 'none', fontWeight: 600, fontSize: '.9375rem' }}>
                                Cancel
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </AppLayout>
    );
}
